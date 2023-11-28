<?php
/**
 *  * Created by PhpStorm.
 * Date: 6/28/2018
 * Time: 2:01 AM
 */

include('ErrorCode.php');

const PREFIX_ADMIN = 'admin';

/*
 * Default avatar
 */
const LOGO_DEFAULT = 'img/logo.png';

/*
 * Other config
 */
const TOKEN_LIFE_TIME = 60 * 24 * 30 * 12; // 60 phút * 24 giờ * 30 ngày * 12 tháng ~ 1 năm.
const MYSQL_FORMAT_DATE = 'Y-m-d H:i:s';
const BIRTHDAY_FORMAT_DATE = 'Y-m-d';
const DEFAULT_LANG = 'vi';
const HUMAN_FORMAT_DATE = 'H:i:s d/m/Y';
// km unit
const PICKER_FORMAT_DATETIME = 'YYYY-MM-DD HH:mm:ss';
const PICKER_FORMAT_DATE = 'YYYY-MM-DD';
/*
 * Google mode transit
 */

/*
 * Gender
 */
const GENDER_UNKNOWN = 'UNKNOWN';
const GENDER_MALE = 'MALE';
const GENDER_FEMALE = 'FEMALE';

/*
 * Device type
 */
const DEVICE_WEB = 'WEB';

const SUPERADMINISTRATOR = 'superadministrator';
const ADMINISTRATOR = 'administrator';

/*
 * Minutes on a session
 */

/*
 * Form type
 */
const FORM_TYPE_TEXT = 'text';
const FORM_TYPE_FILE = 'file';
const FORM_TYPE_MAP = 'map';
const FORM_TYPE_EMAIL = 'email';
const FORM_TYPE_COLOR = 'color';
const FORM_TYPE_TEXTAREA = 'textarea';
const FORM_TYPE_NUMBER = 'number';
const FORM_TYPE_CURRENCY = 'currency';
const FORM_TYPE_EDITOR = 'editor';
const FORM_TYPE_SELECT = 'select';
const FORM_TYPE_SELECT_LEVEL = 'select_level';
const FORM_TYPE_SELECT_LEVEL_MULTI = 'select_level_multi';
const FORM_TYPE_SELECT_MULTI = 'select_multi';
const FORM_TYPE_IMAGE = 'image';
const FORM_TYPE_URL = 'url';
const FORM_TYPE_IMAGE_MULTI = 'image_multi';
const FORM_TYPE_PASSWORD = 'password';
const FORM_TYPE_TIME = 'time';
const FORM_TYPE_DATE = 'date';
const FORM_TYPE_DATETIME = 'datetime';
const FORM_TYPE_HIDDEN = 'hidden';

const IS_ACTIVE_DEFAULT = [1 => 'Active', 0 => 'Inactive'];

const PAYMENT_METHOD_COD = 'COD';

const ORDER_STATUS_NEW = 'NEW';
const ORDER_STATUS_IN_PROCESS = 'IN_PROCESS';
const ORDER_STATUS_DELIVERING = 'DELIVERING';
const ORDER_STATUS_DELIVERED = 'DELIVERED';
const ORDER_STATUS_CANCELED = 'CANCELED';

const GUARD_MEMBER = 'MEMBER';


/*
 * Cache name
 */
const CACHE_SETTING = 'cache_setting';

const ENCRYPT_KEY = '88jQvSSszoeaXCEusHArQjz2By54yPwy';

const POINT_TYPE_REAL = 'real';
const POINT_TYPE_DEMO = 'demo';

const BET_CONDITION_UP = 'up';
const BET_CONDITION_DOWN = 'down';

const TRANSACTION_TYPE_BET = 'bet';
const TRANSACTION_TYPE_RECHARGE = 'recharge';
const TRANSACTION_TYPE_WITHDRAWAL = 'withdrawal';
const TRANSACTION_TYPE_BUY_VIP = 'buy_vip';
const TRANSACTION_TYPE_REF = 'ref';

const TRANSACTION_STATUS_FINISH = 'finish';
const TRANSACTION_STATUS_PENDING = 'pending';
const TRANSACTION_STATUS_PROCESSING = 'processing';
const TRANSACTION_STATUS_CANCEL = 'cancel';

const PAYMENT_TYPE_BANK = 'bank';
const PAYMENT_TYPE_USDT = 'usdt';

const USER_MODE_TRAIL = 'trial';
const USER_MODE_MEMBER = 'member';
const USER_MODE_UNLIMITED = 'unlimited';

const COMMISSION_TYPE_VIP = 'vip';
const COMMISSION_TYPE_TRADE = 'trade';

const CHALLENGE_TYPE_TRADING = 'trading';
const CHALLENGE_TYPE_AGENCY = 'agency';

const CHALLENGE_SCHEDULE_MONTH = 'month';
const CHALLENGE_SCHEDULE_WEEK = 'week';
