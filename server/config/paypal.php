<?php
# @Author: Codeals
# @Date:   20-12-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 03-01-2020
# @Copyright: Codeals

return array(
    // set your paypal credential
    'client_id' => 'AeTtZQnaAkB2KHDEOPR5SElC_yxYlQcvfqmml8Jfftmh0XqyW2_bi7JrxNqzVc3Jr40PJbQUP1AECyzC',
    'secret' => 'EGahXQRb_bGq58GaPw-3N4TnfYuKui1sFTrqMQrGeAzDZ2-PbDwdSqSDc-acIwm0brPbE4iEsxMKrZtp',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'live',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 50,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);
