<?php

require_once __DIR__."/../core/config.php";

class dbconnector {
	public static $ER_HASHCHK = 1000;
	public static $ER_NISAMCHK = 1001;
	public static $ER_NO = 1002;
	public static $ER_YES = 1003;
	public static $ER_CANT_CREATE_FILE = 1004;
	public static $ER_CANT_CREATE_TABLE = 1005;
	public static $ER_CANT_CREATE_DB = 1006;
	public static $ER_DB_CREATE_EXISTS = 1007;
	public static $ER_DB_DROP_EXISTS = 1008;
	public static $ER_DB_DROP_DELETE = 1009;
	public static $ER_DB_DROP_RMDIR = 1010;
	public static $ER_CANT_DELETE_FILE = 1011;
	public static $ER_CANT_FIND_SYSTEM_REC = 1012;
	public static $ER_CANT_GET_STAT = 1013;
	public static $ER_CANT_GET_WD = 1014;
	public static $ER_CANT_LOCK = 1015;
	public static $ER_CANT_OPEN_FILE = 1016;
	public static $ER_FILE_NOT_FOUND = 1017;
	public static $ER_CANT_READ_DIR = 1018;
	public static $ER_CANT_SET_WD = 1019;
	public static $ER_CHECKREAD = 1020;
	public static $ER_DISK_FULL = 1021;
	public static $ER_DUP_KEY = 1022;
	public static $ER_ERROR_ON_CLOSE = 1023;
	public static $ER_ERROR_ON_READ = 1024;
	public static $ER_ERROR_ON_RENAME = 1025;
	public static $ER_ERROR_ON_WRITE = 1026;
	public static $ER_FILE_USED = 1027;
	public static $ER_FILSORT_ABORT = 1028;
	public static $ER_FORM_NOT_FOUND = 1029;
	public static $ER_GET_ERRNO = 1030;
	public static $ER_ILLEGAL_HA = 1031;
	public static $ER_KEY_NOT_FOUND = 1032;
	public static $ER_NOT_FORM_FILE = 1033;
	public static $ER_NOT_KEYFILE = 1034;
	public static $ER_OLD_KEYFILE = 1035;
	public static $ER_OPEN_AS_READONLY = 1036;
	public static $ER_OUTOFMEMORY = 1037;
	public static $ER_OUT_OF_SORTMEMORY = 1038;
	public static $ER_UNEXPECTED_EOF = 1039;
	public static $ER_CON_COUNT_ERROR = 1040;
	public static $ER_OUT_OF_RESOURCES = 1041;
	public static $ER_BAD_HOST_ERROR = 1042;
	public static $ER_HANDSHAKE_ERROR = 1043;
	public static $ER_DBACCESS_DENIED_ERROR = 1044;
	public static $ER_ACCESS_DENIED_ERROR = 1045;
	public static $ER_NO_DB_ERROR = 1046;
	public static $ER_UNKNOWN_COM_ERROR = 1047;
	public static $ER_BAD_NULL_ERROR = 1048;
	public static $ER_BAD_DB_ERROR = 1049;
	public static $ER_TABLE_EXISTS_ERROR = 1050;
	public static $ER_BAD_TABLE_ERROR = 1051;
	public static $ER_NON_UNIQ_ERROR = 1052;
	public static $ER_SERVER_SHUTDOWN = 1053;
	public static $ER_BAD_FIELD_ERROR = 1054;
	public static $ER_WRONG_FIELD_WITH_GROUP = 1055;
	public static $ER_WRONG_GROUP_FIELD = 1056;
	public static $ER_WRONG_SUM_SELECT = 1057;
	public static $ER_WRONG_VALUE_COUNT = 1058;
	public static $ER_TOO_LONG_IDENT = 1059;
	public static $ER_DUP_FIELDNAME = 1060;
	public static $ER_DUP_KEYNAME = 1061;
	public static $ER_DUP_ENTRY = 1062;
	public static $ER_WRONG_FIELD_SPEC = 1063;
	public static $ER_PARSE_ERROR = 1064;
	public static $ER_EMPTY_QUERY = 1065;
	public static $ER_NONUNIQ_TABLE = 1066;
	public static $ER_INVALID_DEFAULT = 1067;
	public static $ER_MULTIPLE_PRI_KEY = 1068;
	public static $ER_TOO_MANY_KEYS = 1069;
	public static $ER_TOO_MANY_KEY_PARTS = 1070;
	public static $ER_TOO_LONG_KEY = 1071;
	public static $ER_KEY_COLUMN_DOES_NOT_EXITS = 1072;
	public static $ER_BLOB_USED_AS_KEY = 1073;
	public static $ER_TOO_BIG_FIELDLENGTH = 1074;
	public static $ER_WRONG_AUTO_KEY = 1075;
	public static $ER_READY = 1076;
	public static $ER_NORMAL_SHUTDOWN = 1077;
	public static $ER_GOT_SIGNAL = 1078;
	public static $ER_SHUTDOWN_COMPLETE = 1079;
	public static $ER_FORCING_CLOSE = 1080;
	public static $ER_IPSOCK_ERROR = 1081;
	public static $ER_NO_SUCH_INDEX = 1082;
	public static $ER_WRONG_FIELD_TERMINATORS = 1083;
	public static $ER_BLOBS_AND_NO_TERMINATED = 1084;
	public static $ER_TEXTFILE_NOT_READABLE = 1085;
	public static $ER_FILE_EXISTS_ERROR = 1086;
	public static $ER_LOAD_INFO = 1087;
	public static $ER_ALTER_INFO = 1088;
	public static $ER_WRONG_SUB_KEY = 1089;
	public static $ER_CANT_REMOVE_ALL_FIELDS = 1090;
	public static $ER_CANT_DROP_FIELD_OR_KEY = 1091;
	public static $ER_INSERT_INFO = 1092;
	public static $ER_INSERT_TABLE_USED = 1093;
	public static $ER_NO_SUCH_THREAD = 1094;
	public static $ER_KILL_DENIED_ERROR = 1095;
	public static $ER_NO_TABLES_USED = 1096;
	public static $ER_TOO_BIG_SET = 1097;
	public static $ER_NO_UNIQUE_LOGFILE = 1098;
	public static $ER_TABLE_NOT_LOCKED_FOR_WRITE = 1099;
	public static $ER_TABLE_NOT_LOCKED = 1100;
	public static $ER_BLOB_CANT_HAVE_DEFAULT = 1101;
	public static $ER_WRONG_DB_NAME = 1102;
	public static $ER_WRONG_TABLE_NAME = 1103;
	public static $ER_TOO_BIG_SELECT = 1104;
	public static $ER_UNKNOWN_ERROR = 1105;
	public static $ER_UNKNOWN_PROCEDURE = 1106;
	public static $ER_WRONG_PARAMCOUNT_TO_PROCEDURE = 1107;
	public static $ER_WRONG_PARAMETERS_TO_PROCEDURE = 1108;
	public static $ER_UNKNOWN_TABLE = 1109;
	public static $ER_FIELD_SPECIFIED_TWICE = 1110;
	public static $ER_INVALID_GROUP_FUNC_USE = 1111;
	public static $ER_UNSUPPORTED_EXTENSION = 1112;
	public static $ER_TABLE_MUST_HAVE_COLUMNS = 1113;
	public static $ER_RECORD_FILE_FULL = 1114;
	public static $ER_UNKNOWN_CHARACTER_SET = 1115;
	public static $ER_TOO_MANY_TABLES = 1116;
	public static $ER_TOO_MANY_FIELDS = 1117;
	public static $ER_TOO_BIG_ROWSIZE = 1118;
	public static $ER_STACK_OVERRUN = 1119;
	public static $ER_WRONG_OUTER_JOIN = 1120;
	public static $ER_NULL_COLUMN_IN_INDEX = 1121;
	public static $ER_CANT_FIND_UDF = 1122;
	public static $ER_CANT_INITIALIZE_UDF = 1123;
	public static $ER_UDF_NO_PATHS = 1124;
	public static $ER_UDF_EXISTS = 1125;
	public static $ER_CANT_OPEN_LIBRARY = 1126;
	public static $ER_CANT_FIND_DL_ENTRY = 1127;
	public static $ER_FUNCTION_NOT_DEFINED = 1128;
	public static $ER_HOST_IS_BLOCKED = 1129;
	public static $ER_HOST_NOT_PRIVILEGED = 1130;
	public static $ER_PASSWORD_ANONYMOUS_USER = 1131;
	public static $ER_PASSWORD_NOT_ALLOWED = 1132;
	public static $ER_PASSWORD_NO_MATCH = 1133;
	public static $ER_UPDATE_INFO = 1134;
	public static $ER_CANT_CREATE_THREAD = 1135;
	public static $ER_WRONG_VALUE_COUNT_ON_ROW = 1136;
	public static $ER_CANT_REOPEN_TABLE = 1137;
	public static $ER_INVALID_USE_OF_NULL = 1138;
	public static $ER_REGEXP_ERROR = 1139;
	public static $ER_MIX_OF_GROUP_FUNC_AND_FIELDS = 1140;
	public static $ER_NONEXISTING_GRANT = 1141;
	public static $ER_TABLEACCESS_DENIED_ERROR = 1142;
	public static $ER_COLUMNACCESS_DENIED_ERROR = 1143;
	public static $ER_ILLEGAL_GRANT_FOR_TABLE = 1144;
	public static $ER_GRANT_WRONG_HOST_OR_USER = 1145;
	public static $ER_NO_SUCH_TABLE = 1146;
	public static $ER_NONEXISTING_TABLE_GRANT = 1147;
	public static $ER_NOT_ALLOWED_COMMAND = 1148;
	public static $ER_SYNTAX_ERROR = 1149;
	public static $ER_DELAYED_CANT_CHANGE_LOCK = 1150;
	public static $ER_TOO_MANY_DELAYED_THREADS = 1151;
	public static $ER_ABORTING_CONNECTION = 1152;
	public static $ER_NET_PACKET_TOO_LARGE = 1153;
	public static $ER_NET_READ_ERROR_FROM_PIPE = 1154;
	public static $ER_NET_FCNTL_ERROR = 1155;
	public static $ER_NET_PACKETS_OUT_OF_ORDER = 1156;
	public static $ER_NET_UNCOMPRESS_ERROR = 1157;
	public static $ER_NET_READ_ERROR = 1158;
	public static $ER_NET_READ_INTERRUPTED = 1159;
	public static $ER_NET_ERROR_ON_WRITE = 1160;
	public static $ER_NET_WRITE_INTERRUPTED = 1161;
	public static $ER_TOO_LONG_STRING = 1162;
	public static $ER_TABLE_CANT_HANDLE_BLOB = 1163;
	public static $ER_TABLE_CANT_HANDLE_AUTO_INCREMENT = 1164;
	public static $ER_DELAYED_INSERT_TABLE_LOCKED = 1165;
	public static $ER_WRONG_COLUMN_NAME = 1166;
	public static $ER_WRONG_KEY_COLUMN = 1167;
	public static $ER_WRONG_MRG_TABLE = 1168;
	public static $ER_DUP_UNIQUE = 1169;
	public static $ER_BLOB_KEY_WITHOUT_LENGTH = 1170;
	public static $ER_PRIMARY_CANT_HAVE_NULL = 1171;
	public static $ER_TOO_MANY_ROWS = 1172;
	public static $ER_REQUIRES_PRIMARY_KEY = 1173;
	public static $ER_NO_RAID_COMPILED = 1174;
	public static $ER_UPDATE_WITHOUT_KEY_IN_SAFE_MODE = 1175;
	public static function connect() {
	$db = null;
		try {
			if (g_db_server == "mysql") {
				$db = new PDO("mysql:host=".g_dbhost.";dbname=".g_dbname.";port=".g_dbport.";", g_dbusr, g_dbpass);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			elseif (g_db_server == "mssql") {
				$db = new PDO("dblib:host=".g_dbhost.";dbname=".g_dbname.";port=".g_dbport.";", g_dbusr, g_dbpass);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		}
		catch (PDOException $ex) {
			$dbError = $ex->getMessage();
			error_log($dbError);
			// print($dbError);
		}

		return $db;
	}

}

?>