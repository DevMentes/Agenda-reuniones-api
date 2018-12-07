<?php

namespace Babilonia\Shared\Errors;

class Errors
{
    const NULL_EMAIL_FIELD = [
        'code' => 10,
        'message' => 'The email field must not be null.'
    ];

    const NULL_PASSWORD_FIELD = [
        'code' => 11,
        'message' => 'The password field must not be null.'
    ];

    const EMPTY_EMAIL = [
        'code' => 12,
        'message' => 'The email  field must not be empty.'
    ];

    const INVALID_EMAIL = [
        'code' => 13,
        'message' => 'The email format must be valid.'
    ];

    const EMPTY_PASSWORD = [
        'code' => 14,
        'message' => 'The password field must not be empty.'
    ];

    const NULL_NAME_FIELD = [
        'code' => 15,
        'message' => 'The name field must not be null.'
    ];

    const NULL_SURNAMES_FIELD = [
        'code' => 16,
        'message' => 'The surnames field must not be null.'
    ];

    const EMPTY_NAME = [
        'code' => 17,
        'message' => 'The name field must not be empty.'
    ];

    const EMPTY_SURNAMES = [
        'code' => 18,
        'message' => 'The surnames field must not be empty.'
    ];

    const INVALID_PASSWORD_LENGTH = [
        'code' => 19,
        'message' => 'The password field must have a minimum length of 8 characters.'
    ];

    const NULL_USERS = [
        'code' => 20,
        'message' => 'The given users must not be null.'
    ];

    const NULL_DATE = [
        'code' => 21,
        'message' => 'The date field must not be null.'
    ];

    const NULL_START_AT = [
        'code' => 22,
        'message' => 'The startAt field must not be null.'
    ];

    const NULL_FINISH_AT = [
        'code' => 23,
        'message' => 'The finishAt field must not be null.'
    ];

    const EMPTY_USERS_LIST = [
        'code' => 24,
        'message' => 'The given users must not be empty.'
    ];

    const EMPTY_DATE = [
        'code' => 25,
        'message' => 'The date field must not be empty.'
    ];

    const EMPTY_START_AT = [
        'code' => 26,
        'message' => 'The startAt field must not be empty.'
    ];

    const EMPTY_FINISH_AT = [
        'code' => 27,
        'message' => 'The finishAt field must not be empty.'
    ];

    const INVALID_TIMES = [
        'code' => 28,
        'message' => 'The startAt field can not be equal or greater than finishAt field.'
    ];

    const UNKNOWN_EMAIL = [
        'code' => 29,
        'message' => 'The email provided is not registered.'
    ];

    const INVALID_CREDENTIALS = [
        'code' => 30,
        'message' => 'The provided credentials are incorrect.'
    ];

    const EMAIL_ALREADY_IN_USE = [
        'code' => 31,
        'message' => 'The provided email is already in use.'
    ];

    const USER_NOT_FOUND = [
        'code' => 32,
        'message' => 'user was not found.'
    ];

    const NULL_USER_ID = [
        'code' => 33,
        'message' => 'The id field must not be null.'
    ];

    const EMPTY_USER_ID = [
        'code' => 34,
        'message' => 'The id field must not be empty.'
    ];

    const NULL_DATE_FIELD = [
        'code' => 35,
        'message' => 'The date field must not be null.'
    ];

    const EMPTY_DATE_FIELD = [
        'code' => 36,
        'message' => 'The date field must not be empty.'
    ];

    const NULL_START_AT_FIELD = [
        'code' => 37,
        'message' => 'The startAt field must not be null.'
    ];

    const EMPTY_START_AT_FIELD = [
        'code' => 38,
        'message' => 'The startAt field must not be empty.'
    ];

    const NULL_FINISH_AT_FIELD = [
        'code' => 39,
        'message' => 'The finishAt field must not be null.'
    ];

    const EMPTY_FINISH_AT_FIELD = [
        'code' => 40,
        'message' => 'The finishAt field must not be empty.'
    ];

    const INVALID_DATE_FORMAT = [
        'code' => 41,
        'message' => 'The date format is invalid, the format should be yyyy-mm-dd.'
    ];

    const INVALID_START_AT_FORMAT = [
        'code' => 42,
        'message' => 'The startAt format is invalid, the format should be hh:mm.'
    ];

    const INVALID_FINISH_AT_FORMAT = [
        'code' => 43,
        'message' => 'The finishAt format is invalid, the format should be hh:mm.'
    ];

    const INVALID_WEEKDAYS = [
        'code' => 44,
        'message' => 'The weekday must be a valid day.'
    ];

    const EMPTY_WEEKDAYS_FIELD = [
        'code' => 45,
        'message' => 'The weekdays field must not be empty.'
    ];
}