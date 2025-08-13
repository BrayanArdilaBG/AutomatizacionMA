import pandas as pd
from sqlalchemy import text, create_engine

# --- CONFIGURACIÓN ---
usuario = "root"
contrasena = ""
host = "localhost"
nombre_bd = "activos_am"

tabla_original = "activos_1000" 
tabla_equipos_final = "equipos"
tabla_responsables = "responsables"
tabla_ubicaciones = "ubicaciones"

# --- EJECUCIÓN DEL SCRIPT ---
try:
    # 1. Conexión a la base de datos
    engine = create_engine(f"mysql+pymysql://{usuario}:{contrasena}@{host}/{nombre_bd}")
    print("Conexión a la base de datos establecida.")

    # 2. Leer la tabla original completa
    print(f"Leyendo la tabla original '{tabla_original}'...")
    df_original = pd.read_sql_table(tabla_original, engine)
    print("Lectura completa.")

    # --- FASE 1: PREPARAR TODOS LOS DATOS EN MEMORIA PRIMERO ---

    # Para los responsables
    print("Extrayendo responsables únicos...")
    df_responsables = df_original[['registro_responsable', 'nombre_responsable', 'apellido_responsable', 'centro_costo_responsable']].drop_duplicates().reset_index(drop=True)
    df_responsables.insert(0, 'id', df_responsables.index + 1) # Creamos un ID único al principio

    # Para las ubicaciones
    print("Extrayendo ubicaciones únicas...")
    df_ubicaciones = df_original[['codigo_geomatico', 'ubicacion', 'ruta_ubicacion_acta']].drop_duplicates().reset_index(drop=True)
    df_ubicaciones.insert(0, 'id', df_ubicaciones.index + 1) # Creamos un ID único al principio

    # Para los equipos
    print("Preparando tabla de equipos...")
    columnas_equipos = [col for col in df_original.columns if col not in ['nombre_responsable', 'apellido_responsable', 'centro_costo_responsable', 'ubicacion', 'ruta_ubicacion_acta']]
    df_equipos = df_original[columnas_equipos].copy()

    # Relacionar equipos con responsables
    df_equipos = pd.merge(df_equipos, df_responsables[['registro_responsable', 'id']], on='registro_responsable', how='left')
    df_equipos.rename(columns={'id': 'responsable_id'}, inplace=True)

    # Relacionar equipos con ubicaciones
    df_equipos = pd.merge(df_equipos, df_ubicaciones[['codigo_geomatico', 'id']], on='codigo_geomatico', how='left')
    df_equipos.rename(columns={'id': 'ubicacion_id'}, inplace=True)
    
    # Eliminar las columnas que ya no necesitamos en la tabla final de equipos
    df_equipos.drop(columns=['registro_responsable', 'codigo_geomatico'], inplace=True)

    # --- FASE 2: BORRAR TABLAS VIEJAS (EN ORDEN INVERSO) Y SUBIR LAS NUEVAS ---

    with engine.connect() as connection:
        print("Borrando tablas antiguas en el orden correcto para evitar errores...")
        # Desactivamos temporalmente la revisión de llaves foráneas para poder borrar
        connection.execute(text("SET FOREIGN_KEY_CHECKS = 0;"))
        connection.execute(text(f"DROP TABLE IF EXISTS {tabla_equipos_final};"))
        connection.execute(text(f"DROP TABLE IF EXISTS {tabla_responsables};"))
        connection.execute(text(f"DROP TABLE IF EXISTS {tabla_ubicaciones};"))
        connection.execute(text("SET FOREIGN_KEY_CHECKS = 1;"))
        print("Tablas antiguas eliminadas.")

    # Subir las nuevas tablas limpias
    print(f"Creando tabla '{tabla_responsables}'...")
    df_responsables.to_sql(tabla_responsables, engine, if_exists='append', index=False)
    
    print(f"Creando tabla '{tabla_ubicaciones}'...")
    df_ubicaciones.to_sql(tabla_ubicaciones, engine, if_exists='append', index=False)
    
    print(f"Creando tabla '{tabla_equipos_final}'...")
    df_equipos.to_sql(tabla_equipos_final, engine, if_exists='append', index=False)

    print("\n--- ¡MIGRACIÓN COMPLETADA CON ÉXITO! ---")
    print("Ahora tienes 3 tablas en tu base de datos, limpias y relacionadas.")

except Exception as e:
    # Necesitas importar 'text' de sqlalchemy para que funcione el 'with'
    from sqlalchemy import text
    print(f"Ocurrió un error: {e}")