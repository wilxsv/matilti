-- PostgreSQL database dump
-- Dumped from database version 9.1.9
-- Dumped by pg_dump version 9.1.9
-- Started on 2013-11-11 11:43:13 CST

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 209 (class 3079 OID 11645)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2252 (class 0 OID 0)
-- Dependencies: 209
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 570 (class 1247 OID 16889)
-- Dependencies: 571 5
-- Name: dominio_email; Type: DOMAIN; Schema: public; Owner: -
--

CREATE DOMAIN dominio_email AS character varying(150)
	CONSTRAINT dominio_email_check CHECK (((VALUE)::text ~ '^[A-Za-z0-9](([_.-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([.-]?[a-zA-Z0-9]+)*).([A-Za-z]{2,})$'::text));


--
-- TOC entry 572 (class 1247 OID 16891)
-- Dependencies: 573 5
-- Name: dominio_ip; Type: DOMAIN; Schema: public; Owner: -
--

CREATE DOMAIN dominio_ip AS character varying(15)
	CONSTRAINT dominio_ip_check CHECK (((family((VALUE)::inet) = 4) OR (family((VALUE)::inet) = 6)));


--
-- TOC entry 574 (class 1247 OID 16893)
-- Dependencies: 575 5
-- Name: dominio_xml; Type: DOMAIN; Schema: public; Owner: -
--

CREATE DOMAIN dominio_xml AS text
	CONSTRAINT dominio_xml_check CHECK ((VALUE)::xml IS DOCUMENT);


--
-- TOC entry 255 (class 1255 OID 18051)
-- Dependencies: 5 693
-- Name: a(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION a() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que envia un mensaje de emergencia a PNC
 * se recibe un numero y una cadena, si el telefono existe se registra,
 * si no, se envia a otros_sms y se le notifica al remitente.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.11.9
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 221 (class 1255 OID 16895)
-- Dependencies: 693 5
-- Name: adduser(text, text, text, bigint); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION adduser(text, text, text, bigint) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que registra un usuario del sistema,
 * se activa por envio de mensajes de texto (sms)
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.04.11
 * Elemplo: SELECT adduser('USER-1', 'un nombre', 'un apellido', 79797373);
 *
*/
DECLARE
    v_username ALIAS FOR $1;
    v_nombre ALIAS FOR $2;
    v_apellido ALIAS FOR $3;
    v_telefono ALIAS FOR $4;
    userid bigint;
BEGIN
    INSERT INTO scd_usuario(
            username, "password", correousuario, detalleusuario, ultimavisitausuario, 
            ipusuario, salt, nombreusuario, apellidousuario, telefonousuario, 
            nacimientousuario, latusuario, lonusuario, direccionusuario, 
            sexousuario, registrousuario, estado_id, localidad_id)
    VALUES (v_username, 'n/a', v_username||'@local.lo', 'usuario registrado desde telefono', now()::timestamp(0) without time zone, 
            '127.0.0.1', 'n/a', v_nombre, v_apellido, v_telefono, 
            now()::date - 365*18, 13.704032, -89.188385, 'n/a', 
            0, now()::timestamp(0) without time zone, 3, 1);
    SELECT last_value INTO userid FROM scd_usuario_id_seq;
    INSERT INTO scd_usuario_rol(usuario_id, rol_id) VALUES (userid, 3);
    RAISE INFO ' :: Usuario [%] registrado con exito :: ', v_username;
    RETURN 1;
END;
$_$;


--
-- TOC entry 259 (class 1255 OID 16896)
-- Dependencies: 5 693
-- Name: cerrar(text, text, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION cerrar(text, text, timestamp without time zone) RETURNS bigint
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que cambia el estado de una denuncia a cerrada
 *
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.11.11
 *
*/
DECLARE
    numero ALIAS FOR $1;
    mensaje ALIAS FOR $2;
    hora ALIAS FOR $3;
    v_telefono BIGINT;
    v_item BIGINT;
    v_id BIGINT;
    v_id_denuncia BIGINT;
    v_limite INTEGER;
    v_mensaje TEXT;
    v_longitud INTEGER;
    v_dato RECORD;
    v_regla INTEGER;
    var INTEGER;
BEGIN
    v_telefono := get_numero(numero);
    IF v_telefono > 0 THEN
	v_item := get_id_usuario(v_telefono);
	IF v_item > 0  THEN
	    IF usuario_es_valido(numero,'cerrar') = TRUE THEN
		    SELECT * INTO v_limite FROM position(' ' in trim(lower(mensaje)));
		    SELECT * INTO v_longitud FROM char_length(trim(lower(mensaje)));
		    SELECT * INTO v_mensaje FROM substring(trim(lower(mensaje)) from v_limite + 1 for v_longitud);
		    v_id_denuncia := get_numero(v_mensaje);
			IF v_id_denuncia > 0 THEN
				SELECT * INTO v_dato FROM "scd_denuncia" WHERE ("id" = v_id_denuncia AND usuario_id = get_id_usuario(v_telefono) );
				IF v_dato.id IS NOT NULL  THEN
					UPDATE "scd_denuncia" SET fechahorafin = hora, denunciaactiva = 0 WHERE ("id" = v_id_denuncia);
					SELECT id INTO v_regla FROM scd_regla_sms WHERE prefijoregla = 'cerrar';
					INSERT INTO scd_recibido(mensajerecibido, usuario_id, fechahorarecibido, regla_id)
					VALUES (mensaje, v_item, hora, v_regla);
					v_id := enviar_sms(v_telefono, 'Denuncia cerrada');
					RAISE INFO ':: Denuncia cerrada ::';
					var := set_log(get_id_usuario(get_numero(numero)), ' ha cerrado una denuncia', '::1');
					RETURN 1;
				END IF;
			END IF;
			SELECT last_value INTO v_id FROM inbox_id_seq;
			INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
			VALUES (mensaje, v_telefono, v_id, hora);
			v_id := enviar_sms(v_telefono, 'No existe ninguna denuncia con ese identificador');
			RAISE INFO ' :: No existe ninguna denuncia con ese identificador :: ';
			RETURN 0;
	   ELSE
		SELECT last_value INTO v_id FROM inbox_id_seq;
		INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
		VALUES (mensaje, v_telefono, v_id, hora);
		v_id := enviar_sms(v_telefono, 'Usuario no esta autorizado para utilizar esa función');
		RETURN 0;
	    END IF;
	ELSE
	   RAISE INFO ' :: Usuario no registrado :: ';
	   SELECT last_value INTO v_id FROM inbox_id_seq;
           INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
           VALUES (mensaje, v_telefono, v_id, hora);
           v_id := enviar_sms(v_telefono, 'Usuario no registrado, para registrarte envia un mensaje con el formato "registrame tusNombres-tusApellidos", ejemplo: "registrame Oscar Arnulfo-Romero Galdamez"');
           RETURN 0;
	END IF;
     ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN 0;
    END IF;
END  
$_$;


--
-- TOC entry 260 (class 1255 OID 16897)
-- Dependencies: 693 5
-- Name: denuncia(text, text, timestamp without time zone, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION denuncia(text, text, timestamp without time zone, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que registra una denuncia, recibe un numero y una cadena,
 * se envia a la entidad más sercana geograficamente (en km.) de acuerdo
 * al parametro registrado, se le notifica a la entidad registrada para solventar las denuncias.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.07.19
 *
 *
*/
DECLARE
    numero ALIAS FOR $1;
    mensaje ALIAS FOR $2;
    hora ALIAS FOR $3;
    parametro ALIAS FOR $4;
    v_telefono BIGINT;
    v_item BIGINT;
    v_id BIGINT;
    v_resultado text;
    v_regla BIGINT;
    var INTEGER;
    v_limite INTEGER;
    v_user RECORD;
    v_entidad RECORD;
BEGIN
    v_telefono := get_numero(numero);
    IF v_telefono > 0 THEN
        v_item := get_id_usuario(v_telefono);
        IF v_item > 0  THEN
	    IF usuario_es_valido(numero, parametro) = TRUE THEN
		    SELECT * INTO v_limite FROM position(' ' in trim(lower(mensaje)));
		    IF v_limite <= 0 THEN
			RAISE INFO ' :: Denuncia enviada con prefijo solamente :: ';
			RETURN 0;
		    ELSIF get_numero(prefijo(regexp_replace(trim(mensaje), '^'||parametro, ''))) > 0 THEN
		        v_regla = get_numero(prefijo(regexp_replace(trim(mensaje), '^'||parametro, '')));--id de denuncia
		        SELECT id, entidad_id, denuncia_id INTO v_user FROM scd_denuncia WHERE id = v_regla AND usuario_id = get_id_usuario(v_telefono) AND denuncia_id ISNULL;
		        IF (v_user.id > 0) THEN
		            RAISE INFO ' :: Seguimiento registrado ::';
    		            INSERT INTO scd_denuncia(mensajedenuncia, fechahorainicio, denunciaactiva, entidad_id, usuario_id, denuncia_id)
		            VALUES ('['||v_user.id||']'||mensaje, hora, 1, v_user.entidad_id, get_id_usuario(v_telefono), v_user.id);
		            RETURN 1;
		        ELSE
		            --
 			    RAISE INFO ' :: Denuncia con identificador invalido :: ';
		            RETURN 0;
		        END IF;
		    ELSE
		        RAISE INFO ' :: Nueva denuncia registrada :: ';
		        SELECT * INTO v_user FROM scd_usuario WHERE id = get_id_usuario(v_telefono);--Busco la coordenada del usuario
		        SELECT last_value INTO v_id FROM scd_denuncia_id_seq;
		        SELECT id, get_distancia(v_user.latusuario, v_user.lonusuario, latentidad, lonentidad), telefonoentidad INTO v_entidad FROM scd_entidad WHERE nombreentidad LIKE parametro||'%' ORDER BY 2 ASC LIMIT 1;
		        --RAISE INFO ' :: ID :: %', v_regla;
		        v_id := v_id + 1;
		        INSERT INTO scd_denuncia(mensajedenuncia, fechahorainicio, denunciaactiva, entidad_id, usuario_id)
		        VALUES (mensaje, hora, 1, v_entidad.id, get_id_usuario(get_numero(numero)));
		        v_resultado := 'Denuncia registrada exitosamente, el identificador es: ' || v_id;
			v_item := v_id;
		        v_id := enviar_sms(v_telefono, v_resultado);
		        var := set_log(get_id_usuario(get_numero(numero)), ' ha abierto una denuncia', '::1');
		        IF (v_entidad.telefonoentidad NOTNULL) THEN
		            v_id := enviar_sms(get_numero(v_entidad.telefonoentidad), '['||v_item||']'||mensaje);
		        END IF;
		        RETURN 1;
		    END IF;
	    ELSE
		SELECT last_value INTO v_id FROM inbox_id_seq;
		INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
		VALUES (mensaje, v_telefono, v_id, hora);
		v_id := enviar_sms(v_telefono, 'Usuario no esta autorizado para utilizar esa función');
		RETURN 0;
	    END IF;
        ELSE
           RAISE INFO ' :: Usuario no registrado :: ';
	   SELECT last_value INTO v_id FROM inbox_id_seq;
           INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
           VALUES (mensaje, v_telefono, v_id, hora);
           v_id := enviar_sms(v_telefono, 'Usuario no registrado, para registrarte envia un mensaje con el formato "registrame tusNombres-tusApellidos", ejemplo: "registrame Oscar Arnulfo-Romero Galdamez"');
           RETURN 0;
        END IF;
    ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 223 (class 1255 OID 16898)
-- Dependencies: 693 5
-- Name: encuesta(text, text, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION encuesta(text, text, timestamp without time zone) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que registra una respuesta a una encuesta
 * se recibe un numero y una cadena, si el telefono existe se registra,
 * si no, se envia a otros_sms y se le notifica al remitente.
 * 
 * Acceso: publico
 * Autor:  Gualberto Escalante - gual23@gmail.com
 * Fecha: 2012.05.23
 *
*/
DECLARE
    numero ALIAS FOR $1;
    mensaje ALIAS FOR $2;
    hora ALIAS FOR $3;
    v_telefono BIGINT;
    v_item BIGINT;
    v_id BIGINT;
    v_hora_inicio timestamp without time zone;
    v_regla BIGINT;
    v_recibido BIGINT;
    v_encontrada INTEGER;
    v_respuestas TEXT;
    v_resultado TEXT;
    var INTEGER;
BEGIN
    v_telefono := get_numero(numero);
    IF v_telefono > 0 THEN
        v_item := get_id_usuario(v_telefono);
        IF v_item > 0  THEN
	    IF usuario_es_valido(v_telefono,"encuesta") = TRUE THEN
		    SELECT fechahorainicio INTO v_hora_inicio FROM scd_encuesta WHERE encuestaactiva = 1;
		    SELECT id INTO v_regla FROM scd_regla_sms WHERE prefijoregla = 'encuesta';	
		    SELECT id INTO v_recibido FROM scd_recibido WHERE usuario_id = v_item AND regla_id = v_regla AND fechahorarecibido > v_hora_inicio;
		    IF v_recibido > 0 THEN
			RAISE INFO ' :: Usuario ya ingreso respuesta anteriormente :: ';
			SELECT last_value INTO v_id FROM inbox_id_seq;
			INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
			VALUES (mensaje, v_telefono, v_id, hora);
			v_id := enviar_sms(v_telefono, 'Ya ingreso una respuesta para esta encuesta.');
			RETURN 0;
		    ELSE
			RAISE INFO ':: Validando respuesta ::';
			v_encontrada := validar_respuesta(mensaje);
			IF v_encontrada > 0 THEN
				INSERT INTO scd_recibido(mensajerecibido, usuario_id, fechahorarecibido, regla_id)
				VALUES (mensaje, v_item, hora, v_regla);
				RAISE INFO ' :: Respuesta registrada :: ';
				var := set_log(get_id_usuario(get_numero(numero)), ' envió respuesta a una encuesta', '::1');
				RETURN 1;
			ELSE
				SELECT respuestasencuesta INTO v_respuestas FROM scd_encuesta WHERE encuestaactiva = 1;
				v_resultado := 'La respuesta enviada no es valida, las opciones de respuesta son las siguientes: ' || v_respuestas;
				v_id := enviar_sms(v_telefono, v_resultado);
				SELECT last_value INTO v_id FROM inbox_id_seq;
				INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
				VALUES (mensaje, v_telefono, v_id, hora);
				RAISE INFO ' :: Notificacion de respuestas validas enviada :: ';
				RETURN 0;
			END IF;
		    END IF;
	    ELSE
		SELECT last_value INTO v_id FROM inbox_id_seq;
		INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
		VALUES (mensaje, v_telefono, v_id, hora);
		v_id := enviar_sms(v_telefono, 'Usuario no esta autorizado para utilizar esa función');
		RETURN 0;
	    END IF;
        ELSE
           RAISE INFO ' :: Usuario no registrado :: ';
	   SELECT last_value INTO v_id FROM inbox_id_seq;
           INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
           VALUES (mensaje, v_telefono, v_id, hora);
           v_id := enviar_sms(v_telefono, 'Usuario no registrado, para registrarte envia un mensaje con el formato "registrame tusNombres-tusApellidos", ejemplo: "registrame Oscar Arnulfo-Romero Galdamez"');
           RETURN 0;
        END IF;
    ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 224 (class 1255 OID 16899)
-- Dependencies: 693 5
-- Name: encuestas(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION encuestas(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que envia informacion de una o varias encuestas,
 * se activa por envio de mensajes de texto (sms), responde de acuerdo a 3 parametros:
 * >> encuestas NULL = envia el listado de las ultimas 4 encuestas realizadas
 * >> encuestas # = envia un mensaje con los resultados de una pregunta pasada
 * >> encuestas hoy = envia un mensaje con los resultados de una pregunta activa
 *
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.06.11
 * Elemplo: SELECT encuestas('#####', 'XX-XX');
 *
*/
DECLARE
    numero ALIAS FOR $1;
    operacion ALIAS FOR $2;
    v_numero INTEGER;
    v_msg TEXT;
    v_tmp TEXT;
    v_item RECORD;
    var integer;
BEGIN
    IF usuario_es_valido(numero, 'encuestas') THEN
        var := set_log( get_id_usuario(get_numero(numero)), ' consulto el resultado de una encuesta', '::1');
        v_msg := regexp_replace(trim(lower(operacion)), '^encuestas', '');
        IF (character_length(v_msg) = 0) THEN
            SELECT id INTO var FROM scd_regla_sms WHERE prefijoregla = 'encuestas';
            INSERT INTO scd_recibido(mensajerecibido, usuario_id, fechahorarecibido, regla_id)
            VALUES (operacion, get_id_usuario(get_numero(numero)), now()::timestamp(0) without time zone, var);
            RAISE INFO ' :: Se enviaran las ultimas 4 encuestas :: ';
            v_msg := 'Las ultimas 4 son: ';
            FOR v_item IN SELECT id, mensajeencuesta FROM scd_encuesta ORDER BY id DESC LIMIT 4 LOOP
                IF (character_length(v_msg) > 30) THEN
                    v_msg := v_msg||' - '||substring(v_item.mensajeencuesta from 1 for 30)||' [#'||v_item.id||']';
                ELSE
                    v_msg := v_msg||' - '||v_item.mensajeencuesta||' [#'||v_item.id||']';
                END IF;
            END LOOP;
            INSERT INTO scd_enviado(mensajeenviado, fechahoraenviado, usuario_id)
            VALUES (v_msg, now()::timestamp(0) without time zone, get_id_usuario(get_numero(numero)));
            RETURN 1;
            --RETURN enviar_sms(get_numero(numero), v_msg);
        ELSIF (trim(v_msg) SIMILAR TO 'hoy') THEN
            FOR v_item IN SELECT id, mensajeencuesta FROM scd_encuesta ORDER BY id DESC LIMIT 1 LOOP
                v_msg := ']';
            END LOOP;
            RAISE INFO 'envio {%} ', v_msg;
            INSERT INTO scd_enviado(mensajeenviado, fechahoraenviado, usuario_id)
            VALUES (mostrar_encuesta(v_item.id), now()::timestamp(0) without time zone, get_id_usuario(get_numero(numero)));
            RETURN 1;
            --RETURN enviar_sms(get_numero(numero), mostrar_encuesta(v_item.id));
        ELSIF (get_numero(trim(v_msg)) > 0 ) THEN
            -- enviar datos para la encuesta actual
            RAISE INFO ' :: Se enviara el resultado de la encuesta con ID [%] :: ', get_numero(trim(v_msg));
            INSERT INTO scd_enviado(mensajeenviado, fechahoraenviado, usuario_id)
            VALUES (mostrar_encuesta(get_numero(trim(v_msg))), now()::timestamp(0) without time zone, get_id_usuario(get_numero(numero)));
            RETURN 1;
            --RETURN enviar_sms(get_numero(numero), mostrar_encuesta(get_numero(trim(v_msg))));
        ELSE
            -- Datos no validos
            RAISE INFO ' :: Parametro no valido para funcion encuestas :: ';
            INSERT INTO scd_enviado(mensajeenviado, fechahoraenviado, usuario_id)
            VALUES ('Parametro no valido para funcion encuestas', now()::timestamp(0) without time zone, get_id_usuario(get_numero(numero)));
            RETURN 0;
            --RETURN enviar_sms(get_numero(numero), 'Parametro no valido para funcion encuestas');
        END IF;
    ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 225 (class 1255 OID 16900)
-- Dependencies: 5 693
-- Name: envia_sms(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION envia_sms() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    res INTEGER;
    v_telefono BIGINT;
BEGIN
    IF (TG_OP = 'INSERT') THEN
        v_telefono := get_numero_usuario(NEW.usuario_id);
        res := enviar_sms(v_telefono, NEW.mensajeenviado);
	IF (res=1) THEN
            RAISE INFO ' :: Mensaje enviado exitosamente :: ';
        ELSE
	    RAISE INFO ' :: Mensaje no pudo ser enviado :: ';
        END IF;
    END IF;
    RETURN NEW;
END;
$$;


--
-- TOC entry 226 (class 1255 OID 16901)
-- Dependencies: 693 5
-- Name: enviar_sms(bigint, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION enviar_sms(bigint, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que registra un sms a enviar
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.02
 * Elemplo: 
 *
*/
DECLARE
    numero ALIAS FOR $1;
    mensaje ALIAS FOR $2;
BEGIN    
    INSERT INTO outbox( destinationnumber, textdecoded, creatorid)
    VALUES ( set_numero(numero), mensaje, 'Gammu 1.28.0');
    --RAISE INFO ' :: Salida de mensaje registrada con exito :: ';
    RETURN 1;
END;
$_$;


--
-- TOC entry 258 (class 1255 OID 16902)
-- Dependencies: 5 693
-- Name: estatus(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION estatus(text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que envia un mensaje de texto al telefono registrado con el estado y roles
 * que posee el usuario en ese momento
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.29
 * Elemplo: SELECT * FROM estatus(79797373);
 *
*/
DECLARE
    numero ALIAS FOR $1;
    v_msg TEXT;
    v_numero BIGINT;
    v_item RECORD;
BEGIN
    v_numero := get_numero(numero);
    IF v_numero > 0 THEN
        SELECT * INTO v_item FROM scd_regla_sms WHERE prefijoregla = 'estatus';
        INSERT INTO scd_recibido(mensajerecibido, usuario_id, fechahorarecibido, regla_id)
        VALUES ('estatus', get_id_usuario(get_numero(numero)), now()::timestamp(0) without time zone, v_item.id);
        SELECT * INTO v_item
        FROM      scd_usuario us, scd_estado es, scd_usuario_rol ur, scd_rol rl
        WHERE    us.telefonousuario = v_numero AND us.estado_id = es.id AND us.id = ur.usuario_id
                 AND ur.rol_id = rl.id ORDER BY 29;
        IF (v_item.id NOTNULL) THEN
            v_msg := 'Hola '||v_item.nombreusuario||' '||v_item.apellidousuario||' tu estado es ['||v_item.nombreestado||'] y usas la red como ['||v_item.detallerol||']';
            RAISE INFO ' :: Enviando estatus a [ % ] :: ', v_numero;
            INSERT INTO scd_enviado(mensajeenviado, fechahoraenviado, usuario_id)
            VALUES (v_msg, now()::timestamp(0) without time zone, get_id_usuario(get_numero(numero)));
            RETURN 1;
            --RETURN enviar_sms(v_numero, v_msg );
        ELSE
            RAISE INFO ' :: Usuario NO registrado :: ';
            RETURN 0;
        END IF;
    ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 254 (class 1255 OID 16903)
-- Dependencies: 693 5
-- Name: filtra_sms_recivido(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION filtra_sms_recivido() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que filtra tuplas en base a una cadena de texto y a un prefijo,
 * si se encuentra el prefijo, el mensaje es enviado a la funcion con ese nombre,
 * el mensaje es recibido si lo permiten las reglas, si no es enviado a otros_sms
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.01 - Actualizado 2013.10.16
 *
*/
DECLARE
    v_item RECORD;
    v_id INTEGER;
    v_parametro TEXT;
    regla INTEGER;
    v_resultado INTEGER;
BEGIN
    IF (TG_OP = 'INSERT') THEN
        SELECT prefijo INTO v_parametro FROM prefijo(NEW.textdecoded);
        --Esta consulta se debe mejorar agregando en el WHERE el numero de telefono [aplicable a funciones que no sean registrame]
        SELECT * INTO v_item FROM scd_regla_sms 
                                  WHERE prefijoregla = v_parametro AND inicioregla <= now() AND finregla >= now();
        IF (v_item.id NOTNULL) THEN
            RAISE INFO ' :: Mensaje con prefijo valido [%] :: ', v_parametro;
            --EXECUTE 'SELECT '||v_parametro||'(NEW.sendernumber, NEW.textdecoded, NEW.receivingdatetime::timestamp(0) without time zone, v_parametro) INTO v_id'
            --INTO v_id
            --USING v_parametro;
            IF (v_parametro = 'pnc' OR v_parametro = 'isdemu' OR v_parametro = 'minsal' OR v_parametro = 'pdh') THEN  --envios hacia anda o defensoria
                v_id := denuncia(NEW.sendernumber, NEW.textdecoded, NEW.receivingdatetime::timestamp(0) without time zone, v_parametro);
            ELSIF (v_parametro = 'estatus') THEN --envio de estatus de usuario
                v_id := estatus(NEW.sendernumber);
            ELSIF (v_parametro = 'invitar') THEN --envio a telefono de una invitacion
                v_id := invitar(NEW.sendernumber, NEW.textdecoded);
            ELSIF (v_parametro = 'masivo' OR v_parametro = 'todas') THEN --envio de mensaje masio a usuarios
                v_id := masivo(NEW.sendernumber, NEW.textdecoded, NEW.receivingdatetime::timestamp(0) without time zone, v_parametro);
            ELSIF (v_parametro = 'cerrar') THEN --cierre de por usuario
                v_id := cerrar(NEW.sendernumber, NEW.textdecoded, NEW.receivingdatetime::timestamp(0) without time zone);
            ELSIF (v_parametro = 'encuesta') THEN -- respuesta a pregunta enviada
                v_id := encuesta(NEW.sendernumber, NEW.textdecoded, NEW.receivingdatetime::timestamp(0) without time zone);
            ELSIF (v_parametro = 'encuestas') THEN -- envia resultado de encuestas
                v_id := encuestas(NEW.sendernumber, NEW.textdecoded);
            ELSIF (v_parametro = 'registrame') THEN --registro de nuevo usuario del sistema
                v_id := registrame(NEW.sendernumber, NEW.textdecoded);
            ELSIF (v_parametro = 'salir') THEN --inabilitacion de usuario del sistema
                v_id := salir(NEW.sendernumber);
            ELSIF (v_parametro = 'panico' OR v_parametro = 'a' OR v_parametro = 'patrulla') THEN --Envia una notificacion a la policia y solicita una patrulla
                v_id := patrulla(NEW.sendernumber, NEW.textdecoded, NEW.receivingdatetime::timestamp(0) without time zone, v_parametro);
            ELSIF (v_parametro = 'sector') THEN --Envia una notificacion a la policia y solicita una patrulla
                v_id := estatus(NEW.sendernumber);
            END IF;
            IF (v_id = 0) THEN
                RAISE INFO ' :: Funcion % con ejecucion FALLIDA :: ', v_parametro;
            ELSE
                RAISE INFO ' :: Funcion % ejecutada con EXITO :: ', v_parametro;
            END IF;
        ELSE
            RAISE INFO ' :: Operacion invalida, regla no tiene asociada una funcion [%] :: ', v_parametro;
            --Registro de mensajes en tabla de sms_otros
            SELECT last_value INTO v_id FROM inbox_id_seq;
            INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
            VALUES (NEW.textdecoded, NEW.sendernumber, v_id, NEW.receivingdatetime);
        END IF;
    END IF;
    RETURN NEW;
END;
$$;


--
-- TOC entry 227 (class 1255 OID 16904)
-- Dependencies: 693 5
-- Name: get_distancia(double precision, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION get_distancia(double precision, double precision, double precision, double precision) RETURNS double precision
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que retorna la distancia en kilometros entre 2 coordenadas geograficas
 * mediante la Fórmula del Haversine - http://es.wikipedia.org/wiki/Fórmula_del_Haversine
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.07.19
 * Elemplo: SELECT * FROM get_distancia(x1, y1, x2, y2);
 * x := latitud,   y := longitud
 *
*/
DECLARE
    x1 ALIAS FOR $1;
    y1 ALIAS FOR $2;
    x2 ALIAS FOR $3;
    y2 ALIAS FOR $4;
    d_lon  double precision;--Distancia entre 2 longitudes
    d_lat  double precision;--Distancia entre 2 latitudes
    tierra double precision;
    var_a double precision;
    var_c double precision;
    distancia double precision;
BEGIN
    tierra = 6371; --Factor de conversion del radio de la tierra en kilometros (~ 3960 millas)

    d_lat = (x2-x1);--radians(x2-x1);
    d_lon = (y2-y1);--radians(y2-y1);
    /*
    var_a = power(sin(d_lat/2), 2) + cos(x1)*cos(x2)*power( sin(d_lon/2), 2);
    var_c = 2*atan2(sqrt(var_a), sqrt(1-var_a));*/
    var_c = acos(cos(radians(x1))*cos(radians(x2))*cos(radians(y2-y1))+sin(radians(x1))*sin(radians(x2)));
    
    RETURN var_c*tierra;
END;
$_$;


--
-- TOC entry 228 (class 1255 OID 16905)
-- Dependencies: 5 693
-- Name: get_id_usuario(bigint); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION get_id_usuario(bigint) RETURNS bigint
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que retorna la llave primaria del usuario asociado
 * al numero consultado, si no existe el usuario retorna el valor de 0
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.04.11
 * Elemplo: SELECT * FROM get_id_usuario(79797373);
 *
*/
DECLARE
    numero ALIAS FOR $1;
    v_item RECORD;
BEGIN
    SELECT * INTO v_item FROM "scd_usuario" WHERE ("telefonousuario" = numero);
    IF v_item.id IS NOT NULL  THEN
        RAISE INFO ' :: Usuario registrado [Telefono con registro asociado en el catalogo de usuarios] :: ';
        RETURN v_item.id;
     ELSE
        RAISE INFO ' :: Usuario no registrado [Telefono sin registro asociado en el catalogo de usuarios] :: ';
        RETURN 0;
     END IF;
END  
$_$;


--
-- TOC entry 229 (class 1255 OID 16906)
-- Dependencies: 5 693
-- Name: get_numero(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION get_numero(text) RETURNS bigint
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que retorna un numero, si recibe un alfanumerico retorna 0
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.04.11
 * Elemplo: SELECT * FROM get_numero('79797373');
 *
*/
DECLARE
    numero ALIAS FOR $1;
    v_numero BIGINT;
BEGIN
    SELECT * INTO v_numero FROM CAST(numero AS bigint);
    RETURN v_numero;
    EXCEPTION
        WHEN invalid_text_representation THEN
            RETURN 0;
END;
$_$;


--
-- TOC entry 230 (class 1255 OID 16907)
-- Dependencies: 5 693
-- Name: get_numero_usuario(bigint); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION get_numero_usuario(bigint) RETURNS bigint
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que retorna el numero del usuario en base a la
 * llave primaria consultada, si no existe, retorna 0
 * 
 * Acceso: publico
 * Autor:  Gualberto Escalante - gual23@gmail.com
 * Fecha: 2012.05.29
 * Elemplo: SELECT * FROM get_numero_usuario(2);
 *
*/
DECLARE
    usuario ALIAS FOR $1;
    v_item RECORD;
BEGIN
    SELECT * INTO v_item FROM "scd_usuario" WHERE ("id" = usuario);
    IF v_item.id IS NOT NULL  THEN
        RAISE INFO ' :: Usuario valido :: ';
        RETURN v_item.telefonousuario;
     ELSE
        RAISE INFO ' :: Usuario no valido :: ';
        RETURN 0;
     END IF;
END  
$_$;


--
-- TOC entry 231 (class 1255 OID 16908)
-- Dependencies: 693 5
-- Name: get_total_encuesta(bigint); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION get_total_encuesta(bigint) RETURNS bigint
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que retorna el total de respuestas de una encuesta
 *
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.06.13
 * Elemplo: SELECT get_total_encuesta(##);
 *
*/
DECLARE
    id_encuesta ALIAS FOR $1;
    v_var bigint; -- cadena variable temporar para concatenar la respuesta final
    v_item RECORD; --registra las tuplas
BEGIN
    SELECT * INTO v_item FROM scd_encuesta WHERE id = id_encuesta;
    IF v_item.id NOTNULL AND v_item.fechahorafin NOTNULL THEN
        SELECT SUM(total) AS total INTO v_var FROM (
            SELECT COUNT(*) AS total FROM scd_recibido WHERE trim(mensajerecibido) LIKE '%encuesta%' AND fechahorarecibido BETWEEN v_item.fechahorainicio AND v_item.fechahorafin
            UNION
            SELECT COUNT(*) AS total FROM scd_otros_sms WHERE trim(mensajeotrosms) LIKE '%encuesta%' AND registrotrosms BETWEEN v_item.fechahorainicio AND v_item.fechahorafin
            ) AS tabla_total;
        IF (v_var = 0) THEN
            RETURN 1;
        ELSE
            RETURN v_var;
        END IF;
    ELSIF (v_item.id NOTNULL AND v_item.fechahorafin ISNULL) THEN
        SELECT SUM(total) AS total INTO v_var FROM (
            SELECT COUNT(*) AS total FROM scd_recibido WHERE trim(mensajerecibido) LIKE '%encuesta%' AND fechahorarecibido >= v_item.fechahorainicio
            UNION
            SELECT COUNT(*) AS total FROM scd_otros_sms WHERE trim(mensajeotrosms) LIKE '%encuesta%' AND registrotrosms >= v_item.fechahorainicio
            ) AS tabla_total;
        IF (v_var = 0) THEN
            RETURN 1;
        ELSE
            RETURN v_var;
        END IF;
    END IF;
    RETURN 0;
END;
$_$;


--
-- TOC entry 232 (class 1255 OID 16909)
-- Dependencies: 5 693
-- Name: guarda_estado(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION guarda_estado() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que se activa en la tabla scd_estado y evita la edicion
 * de una tupla si se trata de modificar el nombre o id de la tupla,
 * asi como tambien si se trata de eliminar.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.04.11
 *
*/
BEGIN
     IF (TG_OP = 'UPDATE') THEN
         IF (NEW.nombreestado <> OLD.nombreestado OR NEW.id <> OLD.id) THEN
             RAISE EXCEPTION ' :: Operacion invalida, nombreestado sin modificaciones :: ';
             RETURN OLD;
         END IF;
         RETURN NEW;
     END IF;
     IF (TG_OP = 'DELETE') THEN
         RAISE EXCEPTION ' :: Operacion invalida, estado sin eliminarse :: ';
         RETURN NULL;
     END IF;
END;
$$;


--
-- TOC entry 222 (class 1255 OID 16910)
-- Dependencies: 693 5
-- Name: guarda_rol(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION guarda_rol() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que se activa en la tabla scd_rol y evita la edicion
 * de una tupla si se trata de modificar el nombre o id de la tupla,
 * asi como tambien si se trata de eliminar.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.23
 *
*/
BEGIN
     IF (TG_OP = 'UPDATE') THEN
         IF (NEW.nombrerol <> OLD.nombrerol OR NEW.id <> OLD.id) THEN
             RAISE EXCEPTION ' :: Operacion invalida, registro sin modificaciones :: ';
             RETURN OLD;
         END IF;
         RETURN NEW;
     END IF;
     IF (TG_OP = 'DELETE') THEN
         RAISE EXCEPTION ' :: Operacion invalida, estado sin eliminarse :: ';
         RETURN NULL;
     END IF;
END;
$$;


--
-- TOC entry 233 (class 1255 OID 16911)
-- Dependencies: 693 5
-- Name: invitar(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION invitar(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que envia un mensaje a todos los usuarios del sistema
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.29
 * Elemplo: SELECT * FROM invitar('79797373', '73737979 MENSAJE PERSONALIZADO DE INVITACION');
 *
*/
DECLARE
    numero ALIAS FOR $1; --Numero de telefono del usuario del sistema
    invitax ALIAS FOR $2; --Numero de telefono de quien se invita al sistema
    v_numero BIGINT;
    v_msg TEXT;
    v_resultado integer;
    v_item RECORD;
    var integer;
BEGIN
    IF usuario_es_valido(numero, 'invitar') THEN
        v_msg := regexp_replace(trim(invitax), '^invitar ', '');
        v_numero := get_numero(prefijo(trim(v_msg)));
        IF v_numero > 0 THEN
            IF get_id_usuario(v_numero) = 0 THEN
                v_msg := REPLACE(v_msg, v_numero::text, '');
                var := set_log( get_id_usuario(get_numero(numero)), ' está haciendo haciendo crecer aún más la red comunicación, invitando a alguine más', '::1');
                IF (character_length(v_msg) >= 6) THEN
                    RETURN enviar_sms(v_numero, v_msg );
                ELSE
                    SELECT * INTO v_item FROM scd_usuario WHERE telefonousuario = get_numero(numero);
                    RETURN enviar_sms( v_numero, 'Hola, '||v_item.nombreusuario||' '||v_item.apellidousuario||' te ha invitado a que formes parte del sistema de comunicacion digital comunitaria.');
                END IF;
            END IF;
        END IF;
        RETURN 0;
    ELSE
        RAISE INFO ' :: Usuario sin privilegios para enviar invitaciones :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 234 (class 1255 OID 16912)
-- Dependencies: 5 693
-- Name: isdemu(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION isdemu() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que registra una denuncia dirigida a ISDEMU
 * se recibe un numero y una cadena, si el telefono existe se registra,
 * si no, se envia a otros_sms y se le notifica al remitente.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.10.16
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 257 (class 1255 OID 17392)
-- Dependencies: 5 693
-- Name: masivo(text, text, timestamp without time zone, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION masivo(text, text, timestamp without time zone, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que envia un mensaje a todos los usuarios del sistema
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.29
 * Elemplo: SELECT * FROM masivo('79797373', 'MENSAJE SIN PREFIJO');
 *
*/
DECLARE
    numero ALIAS FOR $1;
    v_msg ALIAS FOR $2;
    hora ALIAS FOR $3;
    parametro ALIAS FOR $4;
    v_total BIGINT;
    v_item RECORD;
    var integer;
    v_masivo TEXT;
BEGIN
    IF usuario_es_valido(numero, parametro) = TRUE THEN
        v_total := 0;
        v_masivo := regexp_replace(trim(v_msg), '^'||parametro, '');
        SELECT id INTO v_item FROM scd_regla_sms WHERE prefijoregla = parametro;
        INSERT INTO scd_recibido(mensajerecibido, usuario_id, fechahorarecibido, regla_id)
        VALUES (v_msg, get_id_usuario(get_numero(numero)), now()::timestamp(0) without time zone, v_item.id);
        IF (character_length(v_masivo) > 3 ) THEN
            FOR v_item IN SELECT * FROM scd_usuario WHERE estado_id IN (1, 2, 3) LOOP
                INSERT INTO scd_enviado(mensajeenviado, fechahoraenviado, usuario_id)
                VALUES (v_masivo, now()::timestamp(0) without time zone, v_item.id);
                --v_item.id := enviar_sms(v_item.telefonousuario, regexp_replace(trim(v_msg::text), '^masivo', '') );
                v_total := v_total+1;
            END LOOP;
            var := set_log( get_id_usuario(get_numero(numero)), ' envió un mensaje masivo a toda la red de comunicación', '::1');
            RETURN v_total;
        ELSE
            RETURN 0;
        END IF;
    ELSE
        RAISE INFO ' :: Usuario sin privilegios para enviar mensajes masivos :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 235 (class 1255 OID 16914)
-- Dependencies: 693 5
-- Name: minsal(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION minsal() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que registra una denuncia dirigida a MINSAL
 * se recibe un numero y una cadena, si el telefono existe se registra,
 * si no, se envia a otros_sms y se le notifica al remitente.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.10.16
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 236 (class 1255 OID 16915)
-- Dependencies: 5 693
-- Name: mostrar_encuesta(bigint); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION mostrar_encuesta(bigint) RETURNS text
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que retorna una cadeba con el resultado de una encuesta,
 * se activa por envio de mensajes de texto (sms)
 *
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.06.12
 * Elemplo: SELECT mostrar_encuesta(##);
 *
*/
DECLARE
    id_encuesta ALIAS FOR $1;
    v_respuesta TEXT; -- cadena que guarda las respuestas faltantes
    v_tmp TEXT; -- cadena que guarda la respuesta a evaluar para calcular su porcentage
    v_msg TEXT; -- cadena que guarda el mensaje con los porcentages finales
    v_var integer; -- cadena variable temporar para concatenar la respuesta final
    v_poss integer; --variable bandera
    v_cont bigint; -- 
    v_item RECORD; --registra las tuplas
    salir BOOLEAN;
BEGIN
    SELECT * INTO v_item FROM scd_encuesta WHERE id = id_encuesta;
    IF v_item.id NOTNULL THEN
        salir := TRUE;
        v_msg := 'El resultado es: ';
        v_poss := position(',' in trim(v_item.respuestasencuesta));--Posicion de la primer coma
        v_tmp := substring(trim(v_item.respuestasencuesta) from 1 for v_poss-1);
        v_respuesta := substring(trim(v_item.respuestasencuesta) from v_poss+1 for character_length(trim(v_item.respuestasencuesta)));
        v_cont := get_total_encuesta(id_encuesta);
        WHILE (character_length(v_respuesta) > 0 ) LOOP
            --HACER CALCULOS DE PORCENTAGE
            IF (v_item.fechahorafin NOTNULL) THEN
                SELECT COUNT(regla_id) AS total INTO v_var FROM scd_recibido WHERE trim(mensajerecibido) LIKE '%encuesta%' AND trim(mensajerecibido) LIKE '%'||v_tmp||'%' AND fechahorarecibido BETWEEN v_item.fechahorainicio AND v_item.fechahorafin GROUP BY regla_id;
            ELSE
                SELECT COUNT(regla_id) AS total INTO v_var FROM scd_recibido WHERE trim(mensajerecibido) LIKE '%encuesta%' AND trim(mensajerecibido) LIKE '%'||v_tmp||'%' AND fechahorarecibido >= v_item.fechahorainicio GROUP BY regla_id;
            END IF;
            v_msg := v_msg||v_tmp||'='||to_char(100*v_var/v_cont::float, '999D99')||'%, ';
            v_poss := position(',' in trim(v_respuesta));
            if v_poss = 0 THEN
                IF salir ISNULL THEN
                    v_respuesta := NULL;
                END IF;
                salir := NULL;
                v_tmp := v_respuesta;
            ELSE
                v_tmp := substring(trim(v_respuesta) from 1 for v_poss-1);
                v_respuesta := substring(trim(v_respuesta) from v_poss+1 for character_length(trim(v_respuesta)));
            END IF;
        END LOOP;
        IF (v_item.fechahorafin NOTNULL) THEN
            SELECT COUNT(*) AS total INTO v_var FROM scd_otros_sms WHERE trim(mensajeotrosms) LIKE '%encuesta%' AND registrotrosms BETWEEN v_item.fechahorainicio AND v_item.fechahorafin;
        ELSE
            SELECT COUNT(*) AS total INTO v_var FROM scd_otros_sms WHERE trim(mensajeotrosms) LIKE '%encuesta%' AND registrotrosms >= v_item.fechahorainicio;
        END IF;
        v_msg := v_msg||'Otros='||to_char(100*v_var/v_cont::float, '999D99'||'%');
        IF (character_length(v_msg) > 0) THEN
            RETURN v_msg;
        ELSE
            RETURN 'Encuesta sin respuestas a la fecha';
        END IF;
    ELSE
        RAISE INFO ' :: Encuesta no registrada :: ';
        RETURN 'Encuesta no registrada';
    END IF;
END;
$_$;


--
-- TOC entry 237 (class 1255 OID 16916)
-- Dependencies: 693 5
-- Name: nueva_regla(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION nueva_regla() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que habilita el registro de una regla, unicamente si existe
 * una funcion con el mismo nombre (prefijoregla = nombre-funcion).
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.15
 * 
*/
DECLARE
    v_item RECORD;
    costo bigint;
BEGIN
     IF (TG_OP = 'INSERT') THEN
         SELECT procost INTO costo FROM pg_proc WHERE proname = trim(lower(NEW.prefijoregla));/*AND lang.lanname = 'plpgsql'*/
         IF (costo NOTNULL) THEN
             RAISE INFO ' :: Operacion asociada a regla :: ';
             RETURN NEW;
         ELSE
             RAISE EXCEPTION ' :: Operacion invalida, regla no tiene asociada una funcion :: ';
             RETURN NULL;
         END IF;
     END IF;
END;
$$;


--
-- TOC entry 238 (class 1255 OID 16917)
-- Dependencies: 5 693
-- Name: nuevo_usuario(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION nuevo_usuario() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que actualiza el historial de operaciones con la adicion de un nuevo usuario del sistema
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.21
 * 
*/
BEGIN
     IF (TG_OP = 'INSERT') THEN
         INSERT INTO scd_historial_operacion(usuario_id, fechahisoperacion, detallehisoperacion, ipoperacion)
         VALUES (NEW.id, now()::timestamp(0) without time zone, NEW.username||' se ha reguistrado en el sistema.', NEW.ipusuario);
     END IF;
     RETURN NEW;
END;
$$;


--
-- TOC entry 256 (class 1255 OID 18052)
-- Dependencies: 5 693
-- Name: panico(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION panico() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que envia un mensaje de emergencia a PNC
 * se recibe un numero y una cadena, si el telefono existe se registra,
 * si no, se envia a otros_sms y se le notifica al remitente.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.11.9
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 253 (class 1255 OID 16918)
-- Dependencies: 5 693
-- Name: patrulla(text, text, timestamp without time zone, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION patrulla(text, text, timestamp without time zone, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que registra una denuncia, recibe un numero y una cadena,
 * se envia a la entidad más sercana geograficamente (en km.) de acuerdo
 * al parametro registrado, se responde a la denuncia enviando una solicitud de patrulla a una entidad de la pnc
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.10.16
 *
 *
*/
DECLARE
    numero ALIAS FOR $1;
    mensaje ALIAS FOR $2;
    hora ALIAS FOR $3;
    parametro ALIAS FOR $4;
    v_telefono BIGINT;
    v_item BIGINT;
    v_id BIGINT;
    v_resultado text;
    v_regla BIGINT;
    var INTEGER;
    v_limite INTEGER;
    v_user RECORD;
    v_entidad RECORD;
BEGIN
    v_telefono := get_numero(numero);
    IF v_telefono > 0 THEN
        v_item := get_id_usuario(v_telefono);
        IF v_item > 0  THEN
	    IF usuario_es_valido(numero, parametro) = TRUE THEN
		    SELECT * INTO v_limite FROM position(' ' in trim(lower(mensaje)));
		    IF v_limite <= 0 THEN
			--RAISE INFO ' :: Denuncia enviada con prefijo solamente [EMERGENCIA] :: ';
			SELECT * INTO v_user FROM scd_usuario WHERE id = get_id_usuario(v_telefono);--Busco la coordenada del usuario
		        SELECT last_value INTO v_id FROM scd_denuncia_id_seq;
		        SELECT id, get_distancia(v_user.latusuario, v_user.lonusuario, latentidad, lonentidad), telefonoentidad INTO v_entidad FROM scd_entidad WHERE nombreentidad LIKE 'pnc'||'%' ORDER BY 2 ASC LIMIT 1;
		        --RAISE INFO ' :: ID :: %', v_regla;
		        INSERT INTO scd_denuncia(mensajedenuncia, fechahorainicio, denunciaactiva, entidad_id, usuario_id)
		        VALUES (mensaje, hora, 1, v_entidad.id, get_id_usuario(get_numero(numero)));
		        v_resultado := 'Denuncia registrada exitosamente, el identificador es: ' || v_id;
		        v_id := enviar_sms(v_telefono, v_resultado);
		        var := set_log(get_id_usuario(get_numero(numero)), ' ha abierto una denuncia', '::1');
		        IF (v_entidad.telefonoentidad NOTNULL) THEN
		            v_id := enviar_sms(get_numero(v_entidad.telefonoentidad), 'EMERGENCIA - Se requiere una patrulla a: '||v_user.direccionusuario);
		            END IF;
			RETURN 1;
		    ELSIF get_numero(prefijo(regexp_replace(trim(mensaje), '^'||parametro, ''))) > 0 THEN
		        v_regla = get_numero(prefijo(regexp_replace(trim(mensaje), '^'||parametro, '')));--id de denuncia
		        SELECT id, entidad_id, denuncia_id INTO v_user FROM scd_denuncia WHERE id = v_regla AND usuario_id = get_id_usuario(v_telefono) AND denuncia_id ISNULL;
		        IF (v_user.id > 0) THEN
		            RAISE INFO ' :: Seguimiento registrado ::';
    		            INSERT INTO scd_denuncia(mensajedenuncia, fechahorainicio, denunciaactiva, entidad_id, usuario_id, denuncia_id)
		            VALUES (mensaje, hora, 1, v_user.entidad_id, get_id_usuario(v_telefono), v_user.id);
		            RETURN 1;
		        ELSE
		            --
 			    RAISE INFO ' :: Denuncia con identificador invalido :: ';
		            RETURN 0;
		        END IF;
		    ELSE
		        RAISE INFO ' :: Nueva denuncia registrada :: ';
		        SELECT * INTO v_user FROM scd_usuario WHERE id = get_id_usuario(v_telefono);--Busco la coordenada del usuario
		        SELECT last_value INTO v_id FROM scd_denuncia_id_seq;
		        SELECT id, get_distancia(v_user.latusuario, v_user.lonusuario, latentidad, lonentidad), telefonoentidad INTO v_entidad FROM scd_entidad WHERE nombreentidad LIKE 'pnc'||'%' ORDER BY 2 ASC LIMIT 1;
		        --RAISE INFO ' :: ID :: %', v_regla;
		        INSERT INTO scd_denuncia(mensajedenuncia, fechahorainicio, denunciaactiva, entidad_id, usuario_id)
		        VALUES (mensaje, hora, 1, v_entidad.id, get_id_usuario(get_numero(numero)));
		        v_resultado := 'Denuncia registrada exitosamente, el identificador es: ' || v_id;
		        v_id := enviar_sms(v_telefono, v_resultado);
		        var := set_log(get_id_usuario(get_numero(numero)), ' ha abierto una denuncia', '::1');
		        IF (v_entidad.telefonoentidad NOTNULL) THEN
		            v_id := enviar_sms(get_numero(v_entidad.telefonoentidad), 'Se requiere una patrulla a: '||mensaje);
		        END IF;
		        RETURN 1;
		    END IF;
	    ELSE
		SELECT last_value INTO v_id FROM inbox_id_seq;
		INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
		VALUES (mensaje, v_telefono, v_id, hora);
		v_id := enviar_sms(v_telefono, 'Usuario no esta autorizado para utilizar esa función');
		RETURN 0;
	    END IF;
        ELSE
           RAISE INFO ' :: Usuario no registrado :: ';
	   SELECT last_value INTO v_id FROM inbox_id_seq;
           INSERT INTO scd_otros_sms(mensajeotrosms, numerootrosms, inbox_id, registrotrosms)
           VALUES (mensaje, v_telefono, v_id, hora);
           v_id := enviar_sms(v_telefono, 'Usuario no registrado, para registrarte envia un mensaje con el formato "registrame tusNombres-tusApellidos", ejemplo: "registrame Oscar Arnulfo-Romero Galdamez"');
           RETURN 0;
        END IF;
    ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 239 (class 1255 OID 16919)
-- Dependencies: 693 5
-- Name: pdh(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION pdh() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que registra una denuncia dirigida a PDDH
 * se recibe un numero y una cadena, si el telefono existe se registra,
 * si no, se envia a otros_sms y se le notifica al remitente.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.10.16
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 240 (class 1255 OID 16920)
-- Dependencies: 5 693
-- Name: pnc(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION pnc() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que registra una denuncia dirigida a PNC
 * se recibe un numero y una cadena, si el telefono existe se registra,
 * si no, se envia a otros_sms y se le notifica al remitente.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.10.16
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 241 (class 1255 OID 16921)
-- Dependencies: 5 693
-- Name: prefijo(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION prefijo(text) RETURNS text
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que retorna la primer palabra en minusculas de una cadena enviada
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.04.11
 * Elemplo: SELECT * FROM prefijo(' palabra de ejemplo'); - Retorna 'palabra'
 *
*/
DECLARE
    mensaje ALIAS FOR $1;
    v_limite INTEGER;
BEGIN
    SELECT * INTO v_limite FROM position(' ' in trim(lower(mensaje)));
    IF v_limite > 0 THEN
        RETURN substring(trim(lower(mensaje)) from 1 for v_limite-1);
    ELSE
        RETURN trim(lower(mensaje));
    END IF;
END;
$_$;


--
-- TOC entry 242 (class 1255 OID 16922)
-- Dependencies: 693 5
-- Name: registrame(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION registrame(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que registra a un usuario del sistema
 * se recibe un numero y una cadena, si el telefono existe no se registra,
 * si no, se evalua el formato con el nombre eviado y se generan los campos
 * adicionales al usuario
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.04.11
 * Elemplo: SELECT * FROM registrame(79797373, 'registrame juan ernesto-mira alvarez');
 *
*/
DECLARE
    numero ALIAS FOR $1;
    mensaje ALIAS FOR $2;
    v_telefono BIGINT;
    v_limite INTEGER;
    v_mensaje TEXT;
    v_longitud INTEGER;
    v_item BIGINT;
    v_fecha INTEGER;
    v_nombre TEXT;
    v_apellido TEXT;
    v_usr TEXT;
    v_r RECORD;
BEGIN
    v_telefono := get_numero(numero);
    IF v_telefono > 0 THEN
        v_item := get_id_usuario(v_telefono);
        IF v_item = 0  THEN
--            SELECT * INTO v_limite FROM position(' ' in trim(lower(mensaje)));
--            SELECT * INTO v_longitud FROM char_length(trim(lower(mensaje)));
--            SELECT * INTO v_mensaje FROM substring(trim(lower(mensaje)) from v_limite+1 for v_longitud);-- mensaje sin prefijo de registro
            v_mensaje = substring(trim(mensaje::text) from 11 for char_length(trim(mensaje::text)));
            SELECT * INTO v_limite FROM position('-' in v_mensaje);
            IF v_limite > 0 THEN
                SELECT * INTO v_nombre FROM substring(v_mensaje from 1 for v_limite-1);--asignacion de nombre
                SELECT * INTO v_apellido FROM substring(v_mensaje from v_limite+1 for char_length(v_mensaje::text));--asignacion de apellido
                SELECT * INTO v_r FROM scd_usuario_id_seq;
                v_usr := 'usuario-'||v_r.last_value;
                v_limite := adduser(v_usr, v_nombre, v_apellido, v_telefono);
                RAISE INFO ' :: Usuario [%] registrado con exito :: ', v_r.last_value;
                --v_limite := enviar_sms(v_telefono, 'Bienvenido, ya formas parte del sistema de comunicacion digital comunitaria');
                --RETURN v_r.last_value;
                INSERT INTO scd_enviado(mensajeenviado, fechahoraenviado, usuario_id)
                VALUES ('Bienvenido, ya formas parte del sistema de comunicacion digital comunitaria', now()::timestamp(0) without time zone, get_id_usuario(get_numero(numero)));
                RETURN 1;
            ELSE
                RAISE NOTICE ' :: Usuario no registrado [formato incorrecto de nombre y apellido] :: ';
                v_limite := enviar_sms(v_telefono, 'Intenta de nuevo y envia correctamente el mensaje. El formato de registro es "registrame y tu nombre", ejemplo: "registrame Oscar Arnulfo-Romero Galdamez"');
                RETURN 0;
            END IF;
        ELSE
           RAISE INFO ' :: No se registrara este telefono :: ';
           RETURN 0;
        END IF;
    ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 243 (class 1255 OID 16923)
-- Dependencies: 693 5
-- Name: salir(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION salir(text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que modifica el estado a suspendido
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.31
 * Elemplo: SELECT * FROM salir('79797373');
 *
*/
DECLARE
    numero ALIAS FOR $1; --Numero de telefono del usuario del sistema
    var integer;
BEGIN
    IF usuario_es_valido(numero, 'salir') THEN
        var := set_log( get_id_usuario(get_numero(numero)), ' ha dejado la red', '::1');
        UPDATE scd_usuario
         SET ultimavisitausuario=now()::timestamp(0) without time zone, ipusuario='127.0.0.1',estado_id=6
         WHERE telefonousuario=get_numero(numero);
        SELECT id INTO var FROM scd_regla_sms WHERE prefijoregla = 'salir';
        INSERT INTO scd_recibido(mensajerecibido, usuario_id, fechahorarecibido, regla_id)
        VALUES ('salir', get_id_usuario(get_numero(numero)), now()::timestamp(0) without time zone, var);
        RETURN 1;
    ELSE
        RAISE INFO ' :: Usuario sin privilegios :: ';
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 244 (class 1255 OID 16924)
-- Dependencies: 693 5
-- Name: sector(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION sector() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.10.16
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 245 (class 1255 OID 16925)
-- Dependencies: 5 693
-- Name: set_log(bigint, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION set_log(bigint, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que registra una operacion en el sistema
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.06.13
 * Elemplo: SELECT * FROM set_log(id_usuario, 'mensaje de operacion', 'ip origen');
 *
*/
DECLARE
    id_usuario ALIAS FOR $1;
    mensaje ALIAS FOR $2;
    ip_origen ALIAS FOR $3;
    v_item RECORD;
BEGIN
    SELECT * INTO v_item FROM scd_usuario WHERE id = id_usuario;
    IF v_item.id NOTNULL THEN
        INSERT INTO scd_historial_operacion(usuario_id, fechahisoperacion, detallehisoperacion, ipoperacion)
        VALUES (id_usuario, now()::timestamp(0) without time zone, v_item.username||' '||mensaje, ip_origen);
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END;
$_$;


--
-- TOC entry 246 (class 1255 OID 16926)
-- Dependencies: 693 5
-- Name: set_namespace(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION set_namespace() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que elimina las plecas invertidas en una cadena de texto,
 * usado para dar un formato especial a namespace de symfony 2
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.04.11
 * 
*/
BEGIN
     NEW.namespacetitulo = REPLACE(NEW.namespacetitulo, E'\\\\', '');
     RETURN NEW;
END;
$$;


--
-- TOC entry 247 (class 1255 OID 16927)
-- Dependencies: 5 693
-- Name: set_numero(bigint); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION set_numero(bigint) RETURNS text
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que define el formato del numero a enviar por sms
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.23
 * Elemplo: 
 *
*/
DECLARE
    numero ALIAS FOR $1;
BEGIN
    IF (char_length(numero::text) > 8) THEN
        RETURN regexp_replace(numero::text, '^503', '');
    ELSE
        RETURN numero;
    END IF;
END;
$_$;


--
-- TOC entry 248 (class 1255 OID 16928)
-- Dependencies: 5 693
-- Name: set_password(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION set_password() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
/**
 * Funcion que habilita el password unicamente a usuarios web.
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.21
 * 
*/
DECLARE
    item RECORD;
BEGIN
    SELECT * INTO item FROM "scd_usuario" u, "scd_usuario_rol" r WHERE (u.id = NEW.id AND u.id = r.usuario_id AND r.rol_id IN (1,2,5));
    IF item.id NOTNULL THEN
        IF (NEW.estado_id IN (1, 2)) THEN
            RETURN NEW;
        ELSE
	    NEW.password := 'n/a';
        END IF;
    ELSE
        NEW.password := 'n/a';
    END IF;
    RETURN NEW;
END;
$$;


--
-- TOC entry 249 (class 1255 OID 16929)
-- Dependencies: 5 693
-- Name: todas(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION todas() RETURNS integer
    LANGUAGE plpgsql
    AS $$
/**
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2013.10.16
 *
*/
DECLARE
  
BEGIN
   RETURN 0;
END;
$$;


--
-- TOC entry 250 (class 1255 OID 16930)
-- Dependencies: 693 5
-- Name: update_timestamp(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION update_timestamp() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  BEGIN
    NEW.UpdatedInDB := LOCALTIMESTAMP(0);
    RETURN NEW;
  END;
$$;


--
-- TOC entry 251 (class 1255 OID 16931)
-- Dependencies: 5 693
-- Name: usuario_es_valido(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION usuario_es_valido(text, text) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que verifica el nivel de acceso que posee un numero de telefono
 * a las funciones del sistema
 * 
 * Acceso: publico
 * Autor:  William Vides - wilx.sv@gmail.com
 * Fecha: 2012.05.28
 * Elemplo: SELECT * FROM usuario_es_valido(79797373, 'PREFIJO');
 *
*/
DECLARE
    numero ALIAS FOR $1;
    prefijo ALIAS FOR $2;
    v_numero BIGINT;
    v_item RECORD;
BEGIN
    v_numero := get_numero(numero);
    IF v_numero > 0 THEN
        SELECT * INTO v_item
        FROM     scd_usuario us, scd_usuario_rol ur, scd_regla_rol rr, scd_regla_sms rs 
        WHERE    us.telefonousuario = v_numero AND us.estado_id IN (1, 2, 3) AND us.id = ur.usuario_id
                 AND ur.rol_id = rr.rol_id AND rr.regla_id = rs.id AND rs.prefijoregla = prefijo
                 AND rs.inicioregla <= now() AND finregla >= now();
        IF (v_item.id NOTNULL) THEN
            RAISE INFO ' :: Usuario habilitado para ejecutar opción [ % ] :: ', prefijo;
            RETURN TRUE;
        ELSE
            RAISE INFO ' :: Usuario NO habilitado para ejecutar opción [ % ] :: ', prefijo;
            RETURN FALSE;
        END IF;
    ELSE
        RAISE INFO ' :: Usuario no registrado [formato incorrecto de telefono] :: ';
        RETURN FALSE;
    END IF;
END;
$_$;


--
-- TOC entry 252 (class 1255 OID 16932)
-- Dependencies: 693 5
-- Name: validar_respuesta(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION validar_respuesta(text) RETURNS bigint
    LANGUAGE plpgsql
    AS $_$
/**
 * Funcion que verifica si una respuesta es valida
 *
 * 
 * Acceso: publico
 * Autor:  Gualberto Escalante - gual23@gmail.com
 * Fecha: 2012.05.23
 *
*/
DECLARE
    mensaje ALIAS FOR $1;
    v_respuestas TEXT;
    respuestas TEXT[];
    v_limite INTEGER;
    v_mensaje TEXT;
    v_longitud INTEGER;
    v_lim_superior INTEGER;
    v_lim_inferior INTEGER;
    v_encontrada INTEGER;
BEGIN
	    v_encontrada := 0;
       	    SELECT respuestasencuesta INTO v_respuestas FROM scd_encuesta WHERE encuestaactiva = 1;
	    SELECT * INTO v_limite FROM position(' ' in trim(lower(mensaje)));
	    IF v_limite <= 0 THEN
			RETURN 0;
	    END IF;
            SELECT * INTO v_longitud FROM char_length(trim(lower(mensaje)));
            SELECT * INTO v_mensaje FROM substring(trim(lower(mensaje)) from v_limite+1 for v_longitud);
            respuestas := string_to_array(v_respuestas, ',');
            SELECT * INTO v_lim_superior FROM array_upper(respuestas, 1);
            SELECT * INTO v_lim_inferior FROM array_lower(respuestas, 1);	
	    FOR i IN v_lim_inferior .. v_lim_superior LOOP
		respuestas[i] = lower(respuestas[i]);
		IF respuestas[i] = v_mensaje THEN
			v_encontrada := v_encontrada + 1;
		END IF;
	    END LOOP;
	    IF v_encontrada > 0 THEN
		RAISE INFO '::RESPUESTA ENCONTRADA::';
		RETURN 1;
	    ELSE
		RAISE INFO '::RESPUESTA NO ENCONTRADA::';
		RETURN 0;
	    END IF;
END  
$_$;


SET default_with_oids = false;

--
-- TOC entry 161 (class 1259 OID 16933)
-- Dependencies: 5
-- Name: daemons; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE daemons (
    start text NOT NULL,
    info text NOT NULL,
    id integer NOT NULL
);


--
-- TOC entry 162 (class 1259 OID 16939)
-- Dependencies: 161 5
-- Name: daemons_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE daemons_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2253 (class 0 OID 0)
-- Dependencies: 162
-- Name: daemons_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE daemons_id_seq OWNED BY daemons.id;


--
-- TOC entry 163 (class 1259 OID 16941)
-- Dependencies: 2058 5
-- Name: gammu; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE gammu (
    version smallint DEFAULT (0)::smallint NOT NULL,
    id integer NOT NULL
);


--
-- TOC entry 164 (class 1259 OID 16945)
-- Dependencies: 5 163
-- Name: gammu_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE gammu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2254 (class 0 OID 0)
-- Dependencies: 164
-- Name: gammu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE gammu_id_seq OWNED BY gammu.id;


--
-- TOC entry 165 (class 1259 OID 16947)
-- Dependencies: 2060 2061 2062 2063 2064 2065 2066 2067 2069 5
-- Name: inbox; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE inbox (
    updatedindb timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) without time zone NOT NULL,
    receivingdatetime timestamp(0) without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    text text NOT NULL,
    sendernumber character varying(20) DEFAULT ''::character varying NOT NULL,
    coding character varying(255) DEFAULT 'Default_No_Compression'::character varying NOT NULL,
    udh text NOT NULL,
    smscnumber character varying(20) DEFAULT ''::character varying NOT NULL,
    class integer DEFAULT (-1) NOT NULL,
    textdecoded text DEFAULT ''::text NOT NULL,
    id integer NOT NULL,
    recipientid text NOT NULL,
    processed boolean DEFAULT false NOT NULL,
    CONSTRAINT inbox_coding_check CHECK (((coding)::text = ANY (ARRAY[('Default_No_Compression'::character varying)::text, ('Unicode_No_Compression'::character varying)::text, ('8bit'::character varying)::text, ('Default_Compression'::character varying)::text, ('Unicode_Compression'::character varying)::text])))
);


--
-- TOC entry 166 (class 1259 OID 16962)
-- Dependencies: 165 5
-- Name: inbox_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE inbox_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2255 (class 0 OID 0)
-- Dependencies: 166
-- Name: inbox_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE inbox_id_seq OWNED BY inbox.id;


--
-- TOC entry 167 (class 1259 OID 16964)
-- Dependencies: 2070 2071 2072 2073 2074 2075 2076 2077 2078 2079 2080 2082 2083 5
-- Name: outbox; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE outbox (
    updatedindb timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) without time zone NOT NULL,
    insertintodb timestamp(0) without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    sendingdatetime timestamp without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    text text,
    destinationnumber character varying(20) DEFAULT ''::character varying NOT NULL,
    coding character varying(255) DEFAULT 'Default_No_Compression'::character varying NOT NULL,
    udh text,
    class integer DEFAULT (-1),
    textdecoded text DEFAULT ''::text NOT NULL,
    id integer NOT NULL,
    multipart boolean DEFAULT false NOT NULL,
    relativevalidity integer DEFAULT (-1),
    senderid character varying(255),
    sendingtimeout timestamp(0) without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    deliveryreport character varying(10) DEFAULT 'default'::character varying,
    creatorid text NOT NULL,
    CONSTRAINT outbox_coding_check CHECK (((coding)::text = ANY (ARRAY[('Default_No_Compression'::character varying)::text, ('Unicode_No_Compression'::character varying)::text, ('8bit'::character varying)::text, ('Default_Compression'::character varying)::text, ('Unicode_Compression'::character varying)::text]))),
    CONSTRAINT outbox_deliveryreport_check CHECK (((deliveryreport)::text = ANY (ARRAY[('default'::character varying)::text, ('yes'::character varying)::text, ('no'::character varying)::text])))
);


--
-- TOC entry 168 (class 1259 OID 16983)
-- Dependencies: 167 5
-- Name: outbox_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE outbox_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2256 (class 0 OID 0)
-- Dependencies: 168
-- Name: outbox_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE outbox_id_seq OWNED BY outbox.id;


--
-- TOC entry 169 (class 1259 OID 16985)
-- Dependencies: 2084 2085 2086 2088 5
-- Name: outbox_multipart; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE outbox_multipart (
    text text,
    coding character varying(255) DEFAULT 'Default_No_Compression'::character varying NOT NULL,
    udh text,
    class integer DEFAULT (-1),
    textdecoded text,
    id integer NOT NULL,
    sequenceposition integer DEFAULT 1 NOT NULL,
    CONSTRAINT outbox_multipart_coding_check CHECK (((coding)::text = ANY (ARRAY[('Default_No_Compression'::character varying)::text, ('Unicode_No_Compression'::character varying)::text, ('8bit'::character varying)::text, ('Default_Compression'::character varying)::text, ('Unicode_Compression'::character varying)::text])))
);


--
-- TOC entry 170 (class 1259 OID 16995)
-- Dependencies: 169 5
-- Name: outbox_multipart_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE outbox_multipart_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2257 (class 0 OID 0)
-- Dependencies: 170
-- Name: outbox_multipart_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE outbox_multipart_id_seq OWNED BY outbox_multipart.id;


--
-- TOC entry 171 (class 1259 OID 16997)
-- Dependencies: 2089 5
-- Name: pbk; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE pbk (
    id integer NOT NULL,
    groupid integer DEFAULT (-1) NOT NULL,
    name text NOT NULL,
    number text NOT NULL
);


--
-- TOC entry 172 (class 1259 OID 17004)
-- Dependencies: 5
-- Name: pbk_groups; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE pbk_groups (
    name text NOT NULL,
    id integer NOT NULL
);


--
-- TOC entry 173 (class 1259 OID 17010)
-- Dependencies: 5 172
-- Name: pbk_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE pbk_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2258 (class 0 OID 0)
-- Dependencies: 173
-- Name: pbk_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE pbk_groups_id_seq OWNED BY pbk_groups.id;


--
-- TOC entry 174 (class 1259 OID 17012)
-- Dependencies: 171 5
-- Name: pbk_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE pbk_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2259 (class 0 OID 0)
-- Dependencies: 174
-- Name: pbk_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE pbk_id_seq OWNED BY pbk.id;


--
-- TOC entry 175 (class 1259 OID 17014)
-- Dependencies: 2092 2093 2094 2095 2096 2097 2098 2099 2100 5
-- Name: phones; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE phones (
    id text NOT NULL,
    updatedindb timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) without time zone NOT NULL,
    insertintodb timestamp(0) without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    timeout timestamp(0) without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    send boolean DEFAULT false NOT NULL,
    receive boolean DEFAULT false NOT NULL,
    imei character varying(35) NOT NULL,
    client text NOT NULL,
    battery integer DEFAULT 0 NOT NULL,
    signal integer DEFAULT 0 NOT NULL,
    sent integer DEFAULT 0 NOT NULL,
    received integer DEFAULT 0 NOT NULL
);


--
-- TOC entry 176 (class 1259 OID 17029)
-- Dependencies: 5
-- Name: scd_accion; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_accion (
    id bigint NOT NULL,
    tituloaccion character varying(75) NOT NULL,
    uriaccion text,
    detalleaccion text,
    namespacetitulo character varying(150) NOT NULL,
    rol_id bigint NOT NULL
);


--
-- TOC entry 177 (class 1259 OID 17035)
-- Dependencies: 5 176
-- Name: scd_accion_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_accion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2260 (class 0 OID 0)
-- Dependencies: 177
-- Name: scd_accion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_accion_id_seq OWNED BY scd_accion.id;


--
-- TOC entry 178 (class 1259 OID 17037)
-- Dependencies: 2102 5
-- Name: scd_denuncia; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_denuncia (
    id bigint NOT NULL,
    mensajedenuncia character varying(160) NOT NULL,
    fechahorainicio timestamp without time zone NOT NULL,
    fechahorafin timestamp without time zone,
    denunciaactiva numeric(1,0) DEFAULT (1)::numeric NOT NULL,
    entidad_id bigint NOT NULL,
    usuario_id bigint NOT NULL,
    denuncia_id bigint
);


--
-- TOC entry 179 (class 1259 OID 17041)
-- Dependencies: 5 178
-- Name: scd_denuncia_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_denuncia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2261 (class 0 OID 0)
-- Dependencies: 179
-- Name: scd_denuncia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_denuncia_id_seq OWNED BY scd_denuncia.id;


--
-- TOC entry 180 (class 1259 OID 17043)
-- Dependencies: 2104 5
-- Name: scd_encuesta; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_encuesta (
    id bigint NOT NULL,
    mensajeencuesta character varying(160) NOT NULL,
    respuestasencuesta character varying NOT NULL,
    fechahorainicio timestamp without time zone NOT NULL,
    fechahorafin timestamp without time zone,
    encuestaactiva numeric(1,0) DEFAULT 0 NOT NULL
);


--
-- TOC entry 181 (class 1259 OID 17050)
-- Dependencies: 180 5
-- Name: scd_encuesta_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_encuesta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2262 (class 0 OID 0)
-- Dependencies: 181
-- Name: scd_encuesta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_encuesta_id_seq OWNED BY scd_encuesta.id;


--
-- TOC entry 182 (class 1259 OID 17052)
-- Dependencies: 5 570 574
-- Name: scd_entidad; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_entidad (
    id bigint NOT NULL,
    nombreentidad character varying(75) NOT NULL,
    correoentidad dominio_email,
    telefonoentidad character varying(25),
    urlentidad character varying,
    xmlentidad dominio_xml,
    latentidad double precision NOT NULL,
    lonentidad double precision NOT NULL,
    localidad_id bigint NOT NULL
);


--
-- TOC entry 183 (class 1259 OID 17058)
-- Dependencies: 5 182
-- Name: scd_entidad_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_entidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2263 (class 0 OID 0)
-- Dependencies: 183
-- Name: scd_entidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_entidad_id_seq OWNED BY scd_entidad.id;


--
-- TOC entry 184 (class 1259 OID 17060)
-- Dependencies: 5
-- Name: scd_enviado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_enviado (
    id bigint NOT NULL,
    mensajeenviado character varying(160) NOT NULL,
    fechahoraenviado timestamp without time zone NOT NULL,
    encuesta_id bigint,
    respuesta_id bigint,
    usuario_id bigint NOT NULL
);


--
-- TOC entry 185 (class 1259 OID 17063)
-- Dependencies: 184 5
-- Name: scd_enviado_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_enviado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2264 (class 0 OID 0)
-- Dependencies: 185
-- Name: scd_enviado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_enviado_id_seq OWNED BY scd_enviado.id;


--
-- TOC entry 186 (class 1259 OID 17065)
-- Dependencies: 5
-- Name: scd_estado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_estado (
    id bigint NOT NULL,
    nombreestado character varying(75) NOT NULL,
    detalleestado text
);


--
-- TOC entry 187 (class 1259 OID 17071)
-- Dependencies: 186 5
-- Name: scd_estado_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_estado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2265 (class 0 OID 0)
-- Dependencies: 187
-- Name: scd_estado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_estado_id_seq OWNED BY scd_estado.id;


--
-- TOC entry 188 (class 1259 OID 17073)
-- Dependencies: 2109 5 572
-- Name: scd_historial_operacion; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_historial_operacion (
    id integer NOT NULL,
    usuario_id bigint,
    fechahisoperacion timestamp without time zone NOT NULL,
    detallehisoperacion character varying(250) NOT NULL,
    ipoperacion dominio_ip DEFAULT '''''''''''''''127.0.0.1''''''''::character varying''''::character varying''::character varying'::character varying NOT NULL
);


--
-- TOC entry 189 (class 1259 OID 17080)
-- Dependencies: 5 188
-- Name: scd_historial_operacion_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_historial_operacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2266 (class 0 OID 0)
-- Dependencies: 189
-- Name: scd_historial_operacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_historial_operacion_id_seq OWNED BY scd_historial_operacion.id;


--
-- TOC entry 190 (class 1259 OID 17082)
-- Dependencies: 5
-- Name: scd_historial_permiso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_historial_permiso (
    id bigint NOT NULL,
    finhisrol timestamp without time zone NOT NULL,
    rol_id bigint NOT NULL,
    usuario_id bigint NOT NULL
);


--
-- TOC entry 191 (class 1259 OID 17085)
-- Dependencies: 5 190
-- Name: scd_historial_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_historial_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2267 (class 0 OID 0)
-- Dependencies: 191
-- Name: scd_historial_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_historial_rol_id_seq OWNED BY scd_historial_permiso.id;


--
-- TOC entry 192 (class 1259 OID 17087)
-- Dependencies: 5
-- Name: scd_localidad; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_localidad (
    id bigint NOT NULL,
    nombrelocalidad character varying(150) NOT NULL,
    latlocalidad double precision NOT NULL,
    loglocalidad double precision NOT NULL,
    descripcionlocalidad text,
    localidad_id bigint,
    poblacionlocalidad bigint
);


--
-- TOC entry 193 (class 1259 OID 17093)
-- Dependencies: 5 192
-- Name: scd_localidad_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_localidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2268 (class 0 OID 0)
-- Dependencies: 193
-- Name: scd_localidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_localidad_id_seq OWNED BY scd_localidad.id;


--
-- TOC entry 194 (class 1259 OID 17095)
-- Dependencies: 2113 5
-- Name: scd_otros_sms; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_otros_sms (
    id bigint NOT NULL,
    mensajeotrosms text NOT NULL,
    numerootrosms character varying(20) DEFAULT ''::character varying NOT NULL,
    inbox_id bigint NOT NULL,
    registrotrosms timestamp without time zone NOT NULL
);


--
-- TOC entry 195 (class 1259 OID 17102)
-- Dependencies: 5 194
-- Name: scd_otros_sms_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_otros_sms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2269 (class 0 OID 0)
-- Dependencies: 195
-- Name: scd_otros_sms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_otros_sms_id_seq OWNED BY scd_otros_sms.id;


--
-- TOC entry 196 (class 1259 OID 17104)
-- Dependencies: 5
-- Name: scd_recibido; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_recibido (
    id bigint NOT NULL,
    mensajerecibido character varying(160) NOT NULL,
    fechahorarecibido timestamp without time zone NOT NULL,
    regla_id bigint NOT NULL,
    usuario_id bigint NOT NULL
);


--
-- TOC entry 197 (class 1259 OID 17107)
-- Dependencies: 196 5
-- Name: scd_recibido_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_recibido_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2270 (class 0 OID 0)
-- Dependencies: 197
-- Name: scd_recibido_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_recibido_id_seq OWNED BY scd_recibido.id;


--
-- TOC entry 198 (class 1259 OID 17109)
-- Dependencies: 5
-- Name: scd_regla_rol; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_regla_rol (
    regla_id bigint NOT NULL,
    rol_id bigint NOT NULL
);


--
-- TOC entry 199 (class 1259 OID 17112)
-- Dependencies: 2116 5
-- Name: scd_regla_sms; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_regla_sms (
    id bigint NOT NULL,
    nombreregla character varying(75) NOT NULL,
    prefijoregla character varying(10) NOT NULL,
    inicioregla timestamp without time zone NOT NULL,
    finregla timestamp without time zone NOT NULL,
    registroregla timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    descripcionregla character varying(250)
);


--
-- TOC entry 200 (class 1259 OID 17116)
-- Dependencies: 199 5
-- Name: scd_regla_sms_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_regla_sms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2271 (class 0 OID 0)
-- Dependencies: 200
-- Name: scd_regla_sms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_regla_sms_id_seq OWNED BY scd_regla_sms.id;


--
-- TOC entry 201 (class 1259 OID 17118)
-- Dependencies: 5
-- Name: scd_rol; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_rol (
    id integer NOT NULL,
    nombrerol character varying(75) NOT NULL,
    detallerol text
);


--
-- TOC entry 202 (class 1259 OID 17124)
-- Dependencies: 201 5
-- Name: scd_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2272 (class 0 OID 0)
-- Dependencies: 202
-- Name: scd_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_rol_id_seq OWNED BY scd_rol.id;


--
-- TOC entry 203 (class 1259 OID 17126)
-- Dependencies: 2119 2120 2121 572 570 574 5
-- Name: scd_usuario; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_usuario (
    id bigint NOT NULL,
    username character varying(50) NOT NULL,
    password text NOT NULL,
    correousuario dominio_email NOT NULL,
    detalleusuario text,
    ultimavisitausuario timestamp without time zone NOT NULL,
    ipusuario dominio_ip DEFAULT '127.0.0.1'::character varying NOT NULL,
    salt text NOT NULL,
    nombreusuario character varying(150) NOT NULL,
    apellidousuario character varying(150) NOT NULL,
    telefonousuario bigint NOT NULL,
    nacimientousuario date NOT NULL,
    latusuario double precision NOT NULL,
    lonusuario double precision NOT NULL,
    direccionusuario text,
    sexousuario numeric(1,0) DEFAULT 0 NOT NULL,
    registrousuario timestamp without time zone NOT NULL,
    cuentausuario dominio_xml DEFAULT '<cuentas><anda>0000</anda></cuentas>'::text NOT NULL,
    estado_id bigint NOT NULL,
    localidad_id bigint NOT NULL,
    imagenusuario text
);


--
-- TOC entry 204 (class 1259 OID 17135)
-- Dependencies: 5
-- Name: scd_usuario_entidad; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_usuario_entidad (
    usuario_id bigint NOT NULL,
    entidad_id bigint NOT NULL
);


--
-- TOC entry 205 (class 1259 OID 17138)
-- Dependencies: 5 203
-- Name: scd_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE scd_usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2273 (class 0 OID 0)
-- Dependencies: 205
-- Name: scd_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE scd_usuario_id_seq OWNED BY scd_usuario.id;


--
-- TOC entry 206 (class 1259 OID 17140)
-- Dependencies: 5
-- Name: scd_usuario_rol; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE scd_usuario_rol (
    usuario_id bigint NOT NULL,
    rol_id bigint NOT NULL
);


--
-- TOC entry 207 (class 1259 OID 17143)
-- Dependencies: 2123 2124 2125 2126 2127 2128 2129 2130 2131 2132 2133 2134 2135 2137 2138 5
-- Name: sentitems; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE sentitems (
    updatedindb timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) without time zone NOT NULL,
    insertintodb timestamp(0) without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    sendingdatetime timestamp(0) without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL,
    deliverydatetime timestamp(0) without time zone,
    text text NOT NULL,
    destinationnumber character varying(20) DEFAULT ''::character varying NOT NULL,
    coding character varying(255) DEFAULT 'Default_No_Compression'::character varying NOT NULL,
    udh text NOT NULL,
    smscnumber character varying(20) DEFAULT ''::character varying NOT NULL,
    class integer DEFAULT (-1) NOT NULL,
    textdecoded text DEFAULT ''::text NOT NULL,
    id integer NOT NULL,
    senderid character varying(255) NOT NULL,
    sequenceposition integer DEFAULT 1 NOT NULL,
    status character varying(255) DEFAULT 'SendingOK'::character varying NOT NULL,
    statuserror integer DEFAULT (-1) NOT NULL,
    tpmr integer DEFAULT (-1) NOT NULL,
    relativevalidity integer DEFAULT (-1) NOT NULL,
    creatorid text NOT NULL,
    CONSTRAINT sentitems_coding_check CHECK (((coding)::text = ANY (ARRAY[('Default_No_Compression'::character varying)::text, ('Unicode_No_Compression'::character varying)::text, ('8bit'::character varying)::text, ('Default_Compression'::character varying)::text, ('Unicode_Compression'::character varying)::text]))),
    CONSTRAINT sentitems_status_check CHECK (((status)::text = ANY (ARRAY[('SendingOK'::character varying)::text, ('SendingOKNoReport'::character varying)::text, ('SendingError'::character varying)::text, ('DeliveryOK'::character varying)::text, ('DeliveryFailed'::character varying)::text, ('DeliveryPending'::character varying)::text, ('DeliveryUnknown'::character varying)::text, ('Error'::character varying)::text])))
);


--
-- TOC entry 208 (class 1259 OID 17164)
-- Dependencies: 207 5
-- Name: sentitems_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE sentitems_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2274 (class 0 OID 0)
-- Dependencies: 208
-- Name: sentitems_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE sentitems_id_seq OWNED BY sentitems.id;


--
-- TOC entry 2057 (class 2604 OID 17166)
-- Dependencies: 162 161
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY daemons ALTER COLUMN id SET DEFAULT nextval('daemons_id_seq'::regclass);


--
-- TOC entry 2059 (class 2604 OID 17167)
-- Dependencies: 164 163
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY gammu ALTER COLUMN id SET DEFAULT nextval('gammu_id_seq'::regclass);


--
-- TOC entry 2068 (class 2604 OID 17168)
-- Dependencies: 166 165
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY inbox ALTER COLUMN id SET DEFAULT nextval('inbox_id_seq'::regclass);


--
-- TOC entry 2081 (class 2604 OID 17169)
-- Dependencies: 168 167
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY outbox ALTER COLUMN id SET DEFAULT nextval('outbox_id_seq'::regclass);


--
-- TOC entry 2087 (class 2604 OID 17170)
-- Dependencies: 170 169
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY outbox_multipart ALTER COLUMN id SET DEFAULT nextval('outbox_multipart_id_seq'::regclass);


--
-- TOC entry 2090 (class 2604 OID 17171)
-- Dependencies: 174 171
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY pbk ALTER COLUMN id SET DEFAULT nextval('pbk_id_seq'::regclass);


--
-- TOC entry 2091 (class 2604 OID 17172)
-- Dependencies: 173 172
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY pbk_groups ALTER COLUMN id SET DEFAULT nextval('pbk_groups_id_seq'::regclass);


--
-- TOC entry 2101 (class 2604 OID 17173)
-- Dependencies: 177 176
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_accion ALTER COLUMN id SET DEFAULT nextval('scd_accion_id_seq'::regclass);


--
-- TOC entry 2103 (class 2604 OID 17174)
-- Dependencies: 179 178
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_denuncia ALTER COLUMN id SET DEFAULT nextval('scd_denuncia_id_seq'::regclass);


--
-- TOC entry 2105 (class 2604 OID 17175)
-- Dependencies: 181 180
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_encuesta ALTER COLUMN id SET DEFAULT nextval('scd_encuesta_id_seq'::regclass);


--
-- TOC entry 2106 (class 2604 OID 17176)
-- Dependencies: 183 182
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_entidad ALTER COLUMN id SET DEFAULT nextval('scd_entidad_id_seq'::regclass);


--
-- TOC entry 2107 (class 2604 OID 17177)
-- Dependencies: 185 184
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_enviado ALTER COLUMN id SET DEFAULT nextval('scd_enviado_id_seq'::regclass);


--
-- TOC entry 2108 (class 2604 OID 17178)
-- Dependencies: 187 186
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_estado ALTER COLUMN id SET DEFAULT nextval('scd_estado_id_seq'::regclass);


--
-- TOC entry 2110 (class 2604 OID 17179)
-- Dependencies: 189 188
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_historial_operacion ALTER COLUMN id SET DEFAULT nextval('scd_historial_operacion_id_seq'::regclass);


--
-- TOC entry 2111 (class 2604 OID 17180)
-- Dependencies: 191 190
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_historial_permiso ALTER COLUMN id SET DEFAULT nextval('scd_historial_rol_id_seq'::regclass);


--
-- TOC entry 2112 (class 2604 OID 17181)
-- Dependencies: 193 192
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_localidad ALTER COLUMN id SET DEFAULT nextval('scd_localidad_id_seq'::regclass);


--
-- TOC entry 2114 (class 2604 OID 17182)
-- Dependencies: 195 194
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_otros_sms ALTER COLUMN id SET DEFAULT nextval('scd_otros_sms_id_seq'::regclass);


--
-- TOC entry 2115 (class 2604 OID 17183)
-- Dependencies: 197 196
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_recibido ALTER COLUMN id SET DEFAULT nextval('scd_recibido_id_seq'::regclass);


--
-- TOC entry 2117 (class 2604 OID 17184)
-- Dependencies: 200 199
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_regla_sms ALTER COLUMN id SET DEFAULT nextval('scd_regla_sms_id_seq'::regclass);


--
-- TOC entry 2118 (class 2604 OID 17185)
-- Dependencies: 202 201
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_rol ALTER COLUMN id SET DEFAULT nextval('scd_rol_id_seq'::regclass);


--
-- TOC entry 2122 (class 2604 OID 17186)
-- Dependencies: 205 203
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario ALTER COLUMN id SET DEFAULT nextval('scd_usuario_id_seq'::regclass);


--
-- TOC entry 2136 (class 2604 OID 17187)
-- Dependencies: 208 207
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY sentitems ALTER COLUMN id SET DEFAULT nextval('sentitems_id_seq'::regclass);


--
-- TOC entry 2144 (class 2606 OID 17189)
-- Dependencies: 165 165 2247
-- Name: inbox_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY inbox
    ADD CONSTRAINT inbox_pkey PRIMARY KEY (id);


--
-- TOC entry 2150 (class 2606 OID 17191)
-- Dependencies: 169 169 169 2247
-- Name: outbox_multipart_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY outbox_multipart
    ADD CONSTRAINT outbox_multipart_pkey PRIMARY KEY (id, sequenceposition);


--
-- TOC entry 2147 (class 2606 OID 17193)
-- Dependencies: 167 167 2247
-- Name: outbox_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY outbox
    ADD CONSTRAINT outbox_pkey PRIMARY KEY (id);


--
-- TOC entry 2154 (class 2606 OID 17195)
-- Dependencies: 172 172 2247
-- Name: pbk_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY pbk_groups
    ADD CONSTRAINT pbk_groups_pkey PRIMARY KEY (id);


--
-- TOC entry 2152 (class 2606 OID 17197)
-- Dependencies: 171 171 2247
-- Name: pbk_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY pbk
    ADD CONSTRAINT pbk_pkey PRIMARY KEY (id);


--
-- TOC entry 2156 (class 2606 OID 17199)
-- Dependencies: 175 175 2247
-- Name: phones_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY phones
    ADD CONSTRAINT phones_pkey PRIMARY KEY (imei);


--
-- TOC entry 2140 (class 2606 OID 17201)
-- Dependencies: 161 161 2247
-- Name: pk_deamons; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY daemons
    ADD CONSTRAINT pk_deamons PRIMARY KEY (id);


--
-- TOC entry 2172 (class 2606 OID 17203)
-- Dependencies: 186 186 2247
-- Name: pk_estado; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_estado
    ADD CONSTRAINT pk_estado PRIMARY KEY (id);


--
-- TOC entry 2142 (class 2606 OID 17205)
-- Dependencies: 163 163 2247
-- Name: pk_gammu; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY gammu
    ADD CONSTRAINT pk_gammu PRIMARY KEY (id);


--
-- TOC entry 2180 (class 2606 OID 17207)
-- Dependencies: 192 192 2247
-- Name: pk_localidad; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_localidad
    ADD CONSTRAINT pk_localidad PRIMARY KEY (id);


--
-- TOC entry 2182 (class 2606 OID 17209)
-- Dependencies: 194 194 2247
-- Name: pk_otros_sms; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_otros_sms
    ADD CONSTRAINT pk_otros_sms PRIMARY KEY (id);


--
-- TOC entry 2184 (class 2606 OID 17211)
-- Dependencies: 196 196 2247
-- Name: pk_recibido; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_recibido
    ADD CONSTRAINT pk_recibido PRIMARY KEY (id);


--
-- TOC entry 2188 (class 2606 OID 17213)
-- Dependencies: 199 199 2247
-- Name: pk_regla; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_regla_sms
    ADD CONSTRAINT pk_regla PRIMARY KEY (id);


--
-- TOC entry 2186 (class 2606 OID 17215)
-- Dependencies: 198 198 198 2247
-- Name: pk_regla_rol; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_regla_rol
    ADD CONSTRAINT pk_regla_rol PRIMARY KEY (regla_id, rol_id);


--
-- TOC entry 2194 (class 2606 OID 17217)
-- Dependencies: 201 201 2247
-- Name: pk_saf_rol; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_rol
    ADD CONSTRAINT pk_saf_rol PRIMARY KEY (id);


--
-- TOC entry 2158 (class 2606 OID 17219)
-- Dependencies: 176 176 2247
-- Name: pk_scd_accion; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_accion
    ADD CONSTRAINT pk_scd_accion PRIMARY KEY (id);


--
-- TOC entry 2176 (class 2606 OID 17221)
-- Dependencies: 188 188 2247
-- Name: pk_scd_bitacora; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_historial_operacion
    ADD CONSTRAINT pk_scd_bitacora PRIMARY KEY (id);


--
-- TOC entry 2178 (class 2606 OID 17223)
-- Dependencies: 190 190 2247
-- Name: pk_scd_historial_permiso; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_historial_permiso
    ADD CONSTRAINT pk_scd_historial_permiso PRIMARY KEY (id);


--
-- TOC entry 2198 (class 2606 OID 17225)
-- Dependencies: 203 203 2247
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id);


--
-- TOC entry 2204 (class 2606 OID 17227)
-- Dependencies: 204 204 204 2247
-- Name: pk_usuario_entidad; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario_entidad
    ADD CONSTRAINT pk_usuario_entidad PRIMARY KEY (usuario_id, entidad_id);


--
-- TOC entry 2206 (class 2606 OID 17229)
-- Dependencies: 206 206 206 2247
-- Name: pk_usuario_rol; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario_rol
    ADD CONSTRAINT pk_usuario_rol PRIMARY KEY (usuario_id, rol_id);


--
-- TOC entry 2161 (class 2606 OID 17231)
-- Dependencies: 178 178 2247
-- Name: scd_denuncia_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_denuncia
    ADD CONSTRAINT scd_denuncia_pkey PRIMARY KEY (id);


--
-- TOC entry 2163 (class 2606 OID 17233)
-- Dependencies: 180 180 2247
-- Name: scd_encuesta_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_encuesta
    ADD CONSTRAINT scd_encuesta_pkey PRIMARY KEY (id);


--
-- TOC entry 2165 (class 2606 OID 17235)
-- Dependencies: 182 182 2247
-- Name: scd_entidad_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_entidad
    ADD CONSTRAINT scd_entidad_pkey PRIMARY KEY (id);


--
-- TOC entry 2170 (class 2606 OID 17237)
-- Dependencies: 184 184 2247
-- Name: scd_enviado_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_enviado
    ADD CONSTRAINT scd_enviado_pkey PRIMARY KEY (id);


--
-- TOC entry 2174 (class 2606 OID 17239)
-- Dependencies: 186 186 2247
-- Name: scd_estado_nombreestado_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_estado
    ADD CONSTRAINT scd_estado_nombreestado_key UNIQUE (nombreestado);


--
-- TOC entry 2196 (class 2606 OID 17241)
-- Dependencies: 201 201 2247
-- Name: scd_rol_nombrerol_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_rol
    ADD CONSTRAINT scd_rol_nombrerol_key UNIQUE (nombrerol);


--
-- TOC entry 2210 (class 2606 OID 17243)
-- Dependencies: 207 207 207 2247
-- Name: sentitems_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sentitems
    ADD CONSTRAINT sentitems_pkey PRIMARY KEY (id, sequenceposition);


--
-- TOC entry 2200 (class 2606 OID 17245)
-- Dependencies: 203 203 2247
-- Name: unique_correo; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario
    ADD CONSTRAINT unique_correo UNIQUE (correousuario);


--
-- TOC entry 2167 (class 2606 OID 17247)
-- Dependencies: 182 182 2247
-- Name: unique_entidad; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_entidad
    ADD CONSTRAINT unique_entidad UNIQUE (nombreentidad);


--
-- TOC entry 2202 (class 2606 OID 17249)
-- Dependencies: 203 203 2247
-- Name: unique_login; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario
    ADD CONSTRAINT unique_login UNIQUE (username);


--
-- TOC entry 2190 (class 2606 OID 17251)
-- Dependencies: 199 199 2247
-- Name: unique_nombre_regla; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_regla_sms
    ADD CONSTRAINT unique_nombre_regla UNIQUE (nombreregla);


--
-- TOC entry 2192 (class 2606 OID 17253)
-- Dependencies: 199 199 2247
-- Name: unique_patron_regla; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_regla_sms
    ADD CONSTRAINT unique_patron_regla UNIQUE (prefijoregla);


--
-- TOC entry 2159 (class 1259 OID 17254)
-- Dependencies: 178 2247
-- Name: fki_parent_denuncia; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX fki_parent_denuncia ON scd_denuncia USING btree (denuncia_id);


--
-- TOC entry 2168 (class 1259 OID 17255)
-- Dependencies: 184 2247
-- Name: fki_scd_enviado_encuesta_id_fkey -> scd_encuesta; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX "fki_scd_enviado_encuesta_id_fkey -> scd_encuesta" ON scd_enviado USING btree (encuesta_id);


--
-- TOC entry 2145 (class 1259 OID 17256)
-- Dependencies: 167 167 2247
-- Name: outbox_date; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX outbox_date ON outbox USING btree (sendingdatetime, sendingtimeout);


--
-- TOC entry 2148 (class 1259 OID 17257)
-- Dependencies: 167 2247
-- Name: outbox_sender; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX outbox_sender ON outbox USING btree (senderid);


--
-- TOC entry 2207 (class 1259 OID 17258)
-- Dependencies: 207 2247
-- Name: sentitems_date; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sentitems_date ON sentitems USING btree (deliverydatetime);


--
-- TOC entry 2208 (class 1259 OID 17259)
-- Dependencies: 207 2247
-- Name: sentitems_dest; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sentitems_dest ON sentitems USING btree (destinationnumber);


--
-- TOC entry 2211 (class 1259 OID 17260)
-- Dependencies: 207 2247
-- Name: sentitems_sender; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sentitems_sender ON sentitems USING btree (senderid);


--
-- TOC entry 2212 (class 1259 OID 17261)
-- Dependencies: 207 2247
-- Name: sentitems_tpmr; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sentitems_tpmr ON sentitems USING btree (tpmr);


--
-- TOC entry 2239 (class 2620 OID 17262)
-- Dependencies: 184 225 2247
-- Name: envia_sms; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER envia_sms BEFORE INSERT ON scd_enviado FOR EACH ROW EXECUTE PROCEDURE envia_sms();


--
-- TOC entry 2235 (class 2620 OID 17263)
-- Dependencies: 254 165 2247
-- Name: filtra_sms_recivido; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER filtra_sms_recivido BEFORE INSERT ON inbox FOR EACH ROW EXECUTE PROCEDURE filtra_sms_recivido();


--
-- TOC entry 2240 (class 2620 OID 17264)
-- Dependencies: 186 232 2247
-- Name: guarda_estado; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER guarda_estado BEFORE DELETE OR UPDATE ON scd_estado FOR EACH ROW EXECUTE PROCEDURE guarda_estado();


--
-- TOC entry 2242 (class 2620 OID 17265)
-- Dependencies: 201 222 2247
-- Name: guarda_rol; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER guarda_rol BEFORE DELETE OR UPDATE ON scd_rol FOR EACH ROW EXECUTE PROCEDURE guarda_rol();


--
-- TOC entry 2241 (class 2620 OID 17266)
-- Dependencies: 199 237 2247
-- Name: nueva_regla; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER nueva_regla BEFORE INSERT ON scd_regla_sms FOR EACH ROW EXECUTE PROCEDURE nueva_regla();


--
-- TOC entry 2243 (class 2620 OID 17267)
-- Dependencies: 203 238 2247
-- Name: nuevo_usuario; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER nuevo_usuario AFTER INSERT ON scd_usuario FOR EACH ROW EXECUTE PROCEDURE nuevo_usuario();


--
-- TOC entry 2244 (class 2620 OID 17268)
-- Dependencies: 248 203 2247
-- Name: set_password; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER set_password BEFORE INSERT OR UPDATE ON scd_usuario FOR EACH ROW EXECUTE PROCEDURE set_password();


--
-- TOC entry 2236 (class 2620 OID 17269)
-- Dependencies: 250 165 2247
-- Name: update_timestamp; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER update_timestamp BEFORE UPDATE ON inbox FOR EACH ROW EXECUTE PROCEDURE update_timestamp();


--
-- TOC entry 2237 (class 2620 OID 17270)
-- Dependencies: 167 250 2247
-- Name: update_timestamp; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER update_timestamp BEFORE UPDATE ON outbox FOR EACH ROW EXECUTE PROCEDURE update_timestamp();


--
-- TOC entry 2238 (class 2620 OID 17271)
-- Dependencies: 250 175 2247
-- Name: update_timestamp; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER update_timestamp BEFORE UPDATE ON phones FOR EACH ROW EXECUTE PROCEDURE update_timestamp();


--
-- TOC entry 2245 (class 2620 OID 17272)
-- Dependencies: 207 250 2247
-- Name: update_timestamp; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER update_timestamp BEFORE UPDATE ON sentitems FOR EACH ROW EXECUTE PROCEDURE update_timestamp();


--
-- TOC entry 2231 (class 2606 OID 17273)
-- Dependencies: 2164 204 182 2247
-- Name: fk_entidad; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario_entidad
    ADD CONSTRAINT fk_entidad FOREIGN KEY (entidad_id) REFERENCES scd_entidad(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2229 (class 2606 OID 17278)
-- Dependencies: 203 2171 186 2247
-- Name: fk_estado; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario
    ADD CONSTRAINT fk_estado FOREIGN KEY (estado_id) REFERENCES scd_estado(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2224 (class 2606 OID 17283)
-- Dependencies: 2179 192 192 2247
-- Name: fk_localidad; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_localidad
    ADD CONSTRAINT fk_localidad FOREIGN KEY (localidad_id) REFERENCES scd_localidad(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2230 (class 2606 OID 17288)
-- Dependencies: 2179 203 192 2247
-- Name: fk_localidad_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario
    ADD CONSTRAINT fk_localidad_usuario FOREIGN KEY (localidad_id) REFERENCES scd_localidad(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2227 (class 2606 OID 17293)
-- Dependencies: 2187 199 198 2247
-- Name: fk_regla; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_regla_rol
    ADD CONSTRAINT fk_regla FOREIGN KEY (regla_id) REFERENCES scd_regla_sms(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2233 (class 2606 OID 17298)
-- Dependencies: 206 201 2193 2247
-- Name: fk_rol; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario_rol
    ADD CONSTRAINT fk_rol FOREIGN KEY (rol_id) REFERENCES scd_rol(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2228 (class 2606 OID 17303)
-- Dependencies: 2193 198 201 2247
-- Name: fk_rol; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_regla_rol
    ADD CONSTRAINT fk_rol FOREIGN KEY (rol_id) REFERENCES scd_rol(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2213 (class 2606 OID 17308)
-- Dependencies: 201 176 2193 2247
-- Name: fk_scd_accion; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_accion
    ADD CONSTRAINT fk_scd_accion FOREIGN KEY (rol_id) REFERENCES scd_rol(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2234 (class 2606 OID 17313)
-- Dependencies: 2197 206 203 2247
-- Name: fk_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario_rol
    ADD CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) REFERENCES scd_usuario(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2232 (class 2606 OID 17318)
-- Dependencies: 204 203 2197 2247
-- Name: fk_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_usuario_entidad
    ADD CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) REFERENCES scd_usuario(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2222 (class 2606 OID 17323)
-- Dependencies: 2193 190 201 2247
-- Name: historial_rol; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_historial_permiso
    ADD CONSTRAINT historial_rol FOREIGN KEY (rol_id) REFERENCES scd_rol(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2223 (class 2606 OID 17328)
-- Dependencies: 203 190 2197 2247
-- Name: historial_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_historial_permiso
    ADD CONSTRAINT historial_usuario FOREIGN KEY (usuario_id) REFERENCES scd_usuario(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2214 (class 2606 OID 17333)
-- Dependencies: 178 178 2160 2247
-- Name: parent_denuncia; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_denuncia
    ADD CONSTRAINT parent_denuncia FOREIGN KEY (denuncia_id) REFERENCES scd_denuncia(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2215 (class 2606 OID 17338)
-- Dependencies: 203 178 2197 2247
-- Name: pk_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_denuncia
    ADD CONSTRAINT pk_usuario FOREIGN KEY (usuario_id) REFERENCES scd_usuario(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- TOC entry 2216 (class 2606 OID 17343)
-- Dependencies: 182 178 2164 2247
-- Name: scd_denuncia_entidad_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_denuncia
    ADD CONSTRAINT scd_denuncia_entidad_id_fkey FOREIGN KEY (entidad_id) REFERENCES scd_entidad(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2217 (class 2606 OID 17348)
-- Dependencies: 192 2179 182 2247
-- Name: scd_entidad_localidad_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_entidad
    ADD CONSTRAINT scd_entidad_localidad_id_fkey FOREIGN KEY (localidad_id) REFERENCES scd_localidad(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2218 (class 2606 OID 17353)
-- Dependencies: 184 180 2162 2247
-- Name: scd_enviado_encuesta_id_fkey -> scd_encuesta; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_enviado
    ADD CONSTRAINT "scd_enviado_encuesta_id_fkey -> scd_encuesta" FOREIGN KEY (encuesta_id) REFERENCES scd_encuesta(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2219 (class 2606 OID 17358)
-- Dependencies: 196 184 2183 2247
-- Name: scd_enviado_respuesta_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_enviado
    ADD CONSTRAINT scd_enviado_respuesta_id_fkey FOREIGN KEY (respuesta_id) REFERENCES scd_recibido(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2220 (class 2606 OID 17363)
-- Dependencies: 203 184 2197 2247
-- Name: scd_enviado_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_enviado
    ADD CONSTRAINT scd_enviado_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES scd_usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2225 (class 2606 OID 17368)
-- Dependencies: 199 2187 196 2247
-- Name: scd_recibido_regla_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_recibido
    ADD CONSTRAINT scd_recibido_regla_id_fkey FOREIGN KEY (regla_id) REFERENCES scd_regla_sms(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2226 (class 2606 OID 17373)
-- Dependencies: 203 196 2197 2247
-- Name: scd_recibido_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_recibido
    ADD CONSTRAINT scd_recibido_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES scd_usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2221 (class 2606 OID 17378)
-- Dependencies: 188 203 2197 2247
-- Name: usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY scd_historial_operacion
    ADD CONSTRAINT usuario FOREIGN KEY (usuario_id) REFERENCES scd_usuario(id) MATCH FULL ON UPDATE CASCADE ON DELETE RESTRICT;


-- Completed on 2013-11-11 11:43:14 CST

--
-- PostgreSQL database dump complete
--
