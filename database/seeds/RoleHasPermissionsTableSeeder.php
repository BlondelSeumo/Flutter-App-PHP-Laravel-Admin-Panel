<?php
/**
 * File name: RoleHasPermissionsTableSeeder.php
 * Last modified: 2020.05.06 at 10:12:55
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 4,
            ),
            3 => 
            array (
                'permission_id' => 1,
                'role_id' => 5,
            ),
            4 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 3,
                'role_id' => 3,
            ),
            7 =>
                array(
                    'permission_id' => 3,
                    'role_id' => 4,
                ),
            8 =>
                array(
                    'permission_id' => 3,
                    'role_id' => 5,
                ),
            9 =>
                array (
                    'permission_id' => 4,
                    'role_id' => 2,
                ),
            10 =>
                array(
                    'permission_id' => 4,
                    'role_id' => 3,
                ),
            11 =>
                array(
                    'permission_id' => 4,
                    'role_id' => 4,
                ),
            12 =>
                array(
                    'permission_id' => 4,
                    'role_id' => 5,
                ),
            13 =>
                array(
                    'permission_id' => 5,
                    'role_id' => 2,
                ),
            14 => 
            array (
                'permission_id' => 5,
                'role_id' => 3,
            ),
            15 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            16 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            17 => 
            array (
                'permission_id' => 10,
                'role_id' => 2,
            ),
            18 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            19 => 
            array (
                'permission_id' => 15,
                'role_id' => 2,
            ),
            20 => 
            array (
                'permission_id' => 16,
                'role_id' => 2,
            ),
            21 => 
            array (
                'permission_id' => 17,
                'role_id' => 2,
            ),
            22 => 
            array (
                'permission_id' => 18,
                'role_id' => 2,
            ),
            23 => 
            array (
                'permission_id' => 19,
                'role_id' => 2,
            ),
            24 => 
            array (
                'permission_id' => 20,
                'role_id' => 2,
            ),
            25 => 
            array (
                'permission_id' => 21,
                'role_id' => 2,
            ),
            26 => 
            array (
                'permission_id' => 22,
                'role_id' => 2,
            ),
            27 => 
            array (
                'permission_id' => 23,
                'role_id' => 2,
            ),
            28 => 
            array (
                'permission_id' => 24,
                'role_id' => 2,
            ),
            29 => 
            array (
                'permission_id' => 26,
                'role_id' => 2,
            ),
            30 => 
            array (
                'permission_id' => 27,
                'role_id' => 2,
            ),
            31 => 
            array (
                'permission_id' => 27,
                'role_id' => 3,
            ),
            32 =>
                array(
                    'permission_id' => 27,
                    'role_id' => 4,
                ),
            33 =>
                array(
                    'permission_id' => 27,
                    'role_id' => 5,
                ),
            34 =>
                array(
                    'permission_id' => 28,
                    'role_id' => 2,
                ),
            35 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            36 => 
            array (
                'permission_id' => 30,
                'role_id' => 2,
            ),
            37 => 
            array (
                'permission_id' => 30,
                'role_id' => 3,
            ),
            38 => 
            array (
                'permission_id' => 30,
                'role_id' => 4,
            ),
            39 => 
            array (
                'permission_id' => 30,
                'role_id' => 5,
            ),
            40 => 
            array (
                'permission_id' => 31,
                'role_id' => 2,
            ),
            41 => 
            array (
                'permission_id' => 32,
                'role_id' => 2,
            ),
            42 => 
            array (
                'permission_id' => 33,
                'role_id' => 2,
            ),
            43 => 
            array (
                'permission_id' => 33,
                'role_id' => 3,
            ),
            44 => 
            array (
                'permission_id' => 34,
                'role_id' => 2,
            ),
            45 => 
            array (
                'permission_id' => 34,
                'role_id' => 3,
            ),
            46 => 
            array (
                'permission_id' => 35,
                'role_id' => 2,
            ),
            47 => 
            array (
                'permission_id' => 36,
                'role_id' => 2,
            ),
            48 => 
            array (
                'permission_id' => 37,
                'role_id' => 2,
            ),
            49 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            50 => 
            array (
                'permission_id' => 39,
                'role_id' => 2,
            ),
            51 => 
            array (
                'permission_id' => 40,
                'role_id' => 2,
            ),
            52 => 
            array (
                'permission_id' => 41,
                'role_id' => 2,
            ),
            53 => 
            array (
                'permission_id' => 42,
                'role_id' => 2,
            ),
            54 => 
            array (
                'permission_id' => 42,
                'role_id' => 3,
            ),
            55 => 
            array (
                'permission_id' => 43,
                'role_id' => 2,
            ),
            56 => 
            array (
                'permission_id' => 44,
                'role_id' => 2,
            ),
            57 => 
            array (
                'permission_id' => 45,
                'role_id' => 2,
            ),
            58 => 
            array (
                'permission_id' => 46,
                'role_id' => 2,
            ),
            59 => 
            array (
                'permission_id' => 47,
                'role_id' => 2,
            ),
            60 => 
            array (
                'permission_id' => 48,
                'role_id' => 2,
            ),
            61 => 
            array (
                'permission_id' => 48,
                'role_id' => 3,
            ),
            62 => 
            array (
                'permission_id' => 48,
                'role_id' => 5,
            ),
            63 => 
            array (
                'permission_id' => 50,
                'role_id' => 2,
            ),
            64 => 
            array (
                'permission_id' => 51,
                'role_id' => 2,
            ),
            65 => 
            array (
                'permission_id' => 52,
                'role_id' => 2,
            ),
            66 => 
            array (
                'permission_id' => 52,
                'role_id' => 3,
            ),
            67 => 
            array (
                'permission_id' => 52,
                'role_id' => 4,
            ),
            68 => 
            array (
                'permission_id' => 52,
                'role_id' => 5,
            ),
            69 => 
            array (
                'permission_id' => 53,
                'role_id' => 2,
            ),
            70 => 
            array (
                'permission_id' => 53,
                'role_id' => 3,
            ),
            71 => 
            array (
                'permission_id' => 54,
                'role_id' => 2,
            ),
            72 => 
            array (
                'permission_id' => 54,
                'role_id' => 3,
            ),
            73 => 
            array (
                'permission_id' => 55,
                'role_id' => 2,
            ),
            74 => 
            array (
                'permission_id' => 55,
                'role_id' => 3,
            ),
            75 => 
            array (
                'permission_id' => 56,
                'role_id' => 2,
            ),
            76 => 
            array (
                'permission_id' => 56,
                'role_id' => 3,
            ),
            77 => 
            array (
                'permission_id' => 57,
                'role_id' => 2,
            ),
            78 => 
            array (
                'permission_id' => 57,
                'role_id' => 3,
            ),
            79 => 
            array (
                'permission_id' => 58,
                'role_id' => 2,
            ),
            80 => 
            array (
                'permission_id' => 58,
                'role_id' => 3,
            ),
            81 => 
            array (
                'permission_id' => 59,
                'role_id' => 2,
            ),
            82 => 
            array (
                'permission_id' => 59,
                'role_id' => 3,
            ),
            83 => 
            array (
                'permission_id' => 60,
                'role_id' => 2,
            ),
            84 => 
            array (
                'permission_id' => 60,
                'role_id' => 3,
            ),
            85 => 
            array (
                'permission_id' => 61,
                'role_id' => 2,
            ),
            86 => 
            array (
                'permission_id' => 61,
                'role_id' => 3,
            ),
            87 => 
            array (
                'permission_id' => 62,
                'role_id' => 2,
            ),
            88 => 
            array (
                'permission_id' => 62,
                'role_id' => 3,
            ),
            89 => 
            array (
                'permission_id' => 63,
                'role_id' => 2,
            ),
            90 => 
            array (
                'permission_id' => 63,
                'role_id' => 3,
            ),
            91 => 
            array (
                'permission_id' => 64,
                'role_id' => 2,
            ),
            92 => 
            array (
                'permission_id' => 64,
                'role_id' => 3,
            ),
            93 => 
            array (
                'permission_id' => 64,
                'role_id' => 4,
            ),
            94 => 
            array (
                'permission_id' => 64,
                'role_id' => 5,
            ),
            95 => 
            array (
                'permission_id' => 67,
                'role_id' => 2,
            ),
            96 => 
            array (
                'permission_id' => 67,
                'role_id' => 3,
            ),
            97 => 
            array (
                'permission_id' => 67,
                'role_id' => 4,
            ),
            98 => 
            array (
                'permission_id' => 67,
                'role_id' => 5,
            ),
            99 => 
            array (
                'permission_id' => 68,
                'role_id' => 2,
            ),
            100 => 
            array (
                'permission_id' => 68,
                'role_id' => 3,
            ),
            101 => 
            array (
                'permission_id' => 68,
                'role_id' => 4,
            ),
            102 => 
            array (
                'permission_id' => 68,
                'role_id' => 5,
            ),
            103 => 
            array (
                'permission_id' => 69,
                'role_id' => 2,
            ),
            104 => 
            array (
                'permission_id' => 76,
                'role_id' => 2,
            ),
            105 => 
            array (
                'permission_id' => 76,
                'role_id' => 3,
            ),
            106 => 
            array (
                'permission_id' => 77,
                'role_id' => 2,
            ),
            107 => 
            array (
                'permission_id' => 77,
                'role_id' => 3,
            ),
            108 => 
            array (
                'permission_id' => 78,
                'role_id' => 2,
            ),
            109 => 
            array (
                'permission_id' => 78,
                'role_id' => 3,
            ),
            110 => 
            array (
                'permission_id' => 80,
                'role_id' => 2,
            ),
            111 => 
            array (
                'permission_id' => 80,
                'role_id' => 3,
            ),
            112 => 
            array (
                'permission_id' => 81,
                'role_id' => 2,
            ),
            113 => 
            array (
                'permission_id' => 81,
                'role_id' => 3,
            ),
            114 => 
            array (
                'permission_id' => 82,
                'role_id' => 2,
            ),
            115 => 
            array (
                'permission_id' => 82,
                'role_id' => 3,
            ),
            116 => 
            array (
                'permission_id' => 83,
                'role_id' => 2,
            ),
            117 => 
            array (
                'permission_id' => 83,
                'role_id' => 3,
            ),
            118 => 
            array (
                'permission_id' => 83,
                'role_id' => 4,
            ),
            119 => 
            array (
                'permission_id' => 83,
                'role_id' => 5,
            ),
            120 => 
            array (
                'permission_id' => 85,
                'role_id' => 2,
            ),
            121 => 
            array (
                'permission_id' => 86,
                'role_id' => 2,
            ),
            122 => 
            array (
                'permission_id' => 86,
                'role_id' => 3,
            ),
            123 => 
            array (
                'permission_id' => 86,
                'role_id' => 4,
            ),
            124 => 
            array (
                'permission_id' => 86,
                'role_id' => 5,
            ),
            125 => 
            array (
                'permission_id' => 87,
                'role_id' => 2,
            ),
            126 => 
            array (
                'permission_id' => 88,
                'role_id' => 2,
            ),
            127 => 
            array (
                'permission_id' => 89,
                'role_id' => 2,
            ),
            128 => 
            array (
                'permission_id' => 90,
                'role_id' => 2,
            ),
            129 => 
            array (
                'permission_id' => 91,
                'role_id' => 2,
            ),
            130 => 
            array (
                'permission_id' => 92,
                'role_id' => 2,
            ),
            131 => 
            array (
                'permission_id' => 92,
                'role_id' => 3,
            ),
            132 => 
            array (
                'permission_id' => 92,
                'role_id' => 4,
            ),
            133 => 
            array (
                'permission_id' => 92,
                'role_id' => 5,
            ),
            134 =>
                array(
                    'permission_id' => 95,
                    'role_id' => 2,
                ),
            135 => 
            array (
                'permission_id' => 95,
                'role_id' => 3,
            ),
            136 => 
            array (
                'permission_id' => 95,
                'role_id' => 4,
            ),
            137 =>
                array(
                    'permission_id' => 95,
                    'role_id' => 5,
                ),
            138 =>
                array(
                    'permission_id' => 96,
                    'role_id' => 2,
                ),
            139 =>
                array(
                    'permission_id' => 96,
                    'role_id' => 3,
                ),
            140 =>
                array(
                    'permission_id' => 96,
                    'role_id' => 4,
                ),
            141 =>
                array(
                    'permission_id' => 96,
                    'role_id' => 5,
                ),
            142 => 
            array (
                'permission_id' => 97,
                'role_id' => 2,
            ),
            143 => 
            array (
                'permission_id' => 98,
                'role_id' => 2,
            ),
            144 => 
            array (
                'permission_id' => 98,
                'role_id' => 3,
            ),
            145 => 
            array (
                'permission_id' => 98,
                'role_id' => 4,
            ),
            146 => 
            array (
                'permission_id' => 98,
                'role_id' => 5,
            ),
            147 => 
            array (
                'permission_id' => 103,
                'role_id' => 2,
            ),
            148 => 
            array (
                'permission_id' => 103,
                'role_id' => 3,
            ),
            149 => 
            array (
                'permission_id' => 103,
                'role_id' => 4,
            ),
            150 => 
            array (
                'permission_id' => 103,
                'role_id' => 5,
            ),
            151 => 
            array (
                'permission_id' => 104,
                'role_id' => 2,
            ),
            152 => 
            array (
                'permission_id' => 104,
                'role_id' => 3,
            ),
            153 => 
            array (
                'permission_id' => 104,
                'role_id' => 4,
            ),
            154 => 
            array (
                'permission_id' => 104,
                'role_id' => 5,
            ),
            155 => 
            array (
                'permission_id' => 107,
                'role_id' => 2,
            ),
            156 => 
            array (
                'permission_id' => 107,
                'role_id' => 3,
            ),
            157 => 
            array (
                'permission_id' => 107,
                'role_id' => 4,
            ),
            158 => 
            array (
                'permission_id' => 107,
                'role_id' => 5,
            ),
            159 => 
            array (
                'permission_id' => 108,
                'role_id' => 2,
            ),
            160 => 
            array (
                'permission_id' => 108,
                'role_id' => 3,
            ),
            161 => 
            array (
                'permission_id' => 109,
                'role_id' => 2,
            ),
            162 => 
            array (
                'permission_id' => 109,
                'role_id' => 3,
            ),
            163 => 
            array (
                'permission_id' => 110,
                'role_id' => 2,
            ),
            164 => 
            array (
                'permission_id' => 110,
                'role_id' => 3,
            ),
            165 => 
            array (
                'permission_id' => 111,
                'role_id' => 2,
            ),
            166 => 
            array (
                'permission_id' => 111,
                'role_id' => 3,
            ),
            167 => 
            array (
                'permission_id' => 111,
                'role_id' => 4,
            ),
            168 => 
            array (
                'permission_id' => 111,
                'role_id' => 5,
            ),
            169 => 
            array (
                'permission_id' => 112,
                'role_id' => 2,
            ),
            170 => 
            array (
                'permission_id' => 113,
                'role_id' => 2,
            ),
            171 => 
            array (
                'permission_id' => 113,
                'role_id' => 3,
            ),
            172 => 
            array (
                'permission_id' => 113,
                'role_id' => 4,
            ),
            173 => 
            array (
                'permission_id' => 113,
                'role_id' => 5,
            ),
            174 => 
            array (
                'permission_id' => 114,
                'role_id' => 2,
            ),
            175 => 
            array (
                'permission_id' => 114,
                'role_id' => 3,
            ),
            176 => 
            array (
                'permission_id' => 114,
                'role_id' => 4,
            ),
            177 => 
            array (
                'permission_id' => 114,
                'role_id' => 5,
            ),
            178 => 
            array (
                'permission_id' => 117,
                'role_id' => 2,
            ),
            179 => 
            array (
                'permission_id' => 117,
                'role_id' => 3,
            ),
            180 => 
            array (
                'permission_id' => 117,
                'role_id' => 4,
            ),
            181 => 
            array (
                'permission_id' => 117,
                'role_id' => 5,
            ),
            182 => 
            array (
                'permission_id' => 118,
                'role_id' => 2,
            ),
            183 => 
            array (
                'permission_id' => 119,
                'role_id' => 2,
            ),
            184 => 
            array (
                'permission_id' => 120,
                'role_id' => 2,
            ),
            185 => 
            array (
                'permission_id' => 121,
                'role_id' => 2,
            ),
            186 => 
            array (
                'permission_id' => 122,
                'role_id' => 2,
            ),
            187 => 
            array (
                'permission_id' => 123,
                'role_id' => 2,
            ),
            188 => 
            array (
                'permission_id' => 124,
                'role_id' => 2,
            ),
            189 =>
                array(
                    'permission_id' => 127,
                    'role_id' => 2,
                ),
            190 =>
                array(
                    'permission_id' => 128,
                    'role_id' => 2,
                ),
            191 => 
            array (
                'permission_id' => 129,
                'role_id' => 2,
            ),
            192 => 
            array (
                'permission_id' => 130,
                'role_id' => 2,
            ),
            193 => 
            array (
                'permission_id' => 130,
                'role_id' => 3,
            ),
            194 => 
            array (
                'permission_id' => 130,
                'role_id' => 5,
            ),
            195 => 
            array (
                'permission_id' => 131,
                'role_id' => 2,
            ),
            196 => 
            array (
                'permission_id' => 134,
                'role_id' => 2,
            ),
            197 => 
            array (
                'permission_id' => 134,
                'role_id' => 3,
            ),
            198 => 
            array (
                'permission_id' => 135,
                'role_id' => 2,
            ),
            199 => 
            array (
                'permission_id' => 135,
                'role_id' => 3,
            ),
            200 => 
            array (
                'permission_id' => 137,
                'role_id' => 2,
            ),
            201 => 
            array (
                'permission_id' => 137,
                'role_id' => 3,
            ),
            202 => 
            array (
                'permission_id' => 138,
                'role_id' => 2,
            ),
            203 => 
            array (
                'permission_id' => 144,
                'role_id' => 2,
            ),
            204 => 
            array (
                'permission_id' => 144,
                'role_id' => 5,
            ),
            205 => 
            array (
                'permission_id' => 145,
                'role_id' => 2,
            ),
            206 => 
            array (
                'permission_id' => 145,
                'role_id' => 3,
            ),
            207 => 
            array (
                'permission_id' => 145,
                'role_id' => 5,
            ),
            208 => 
            array (
                'permission_id' => 146,
                'role_id' => 2,
            ),
            209 => 
            array (
                'permission_id' => 146,
                'role_id' => 3,
            ),
            210 => 
            array (
                'permission_id' => 146,
                'role_id' => 5,
            ),
            211 => 
            array (
                'permission_id' => 148,
                'role_id' => 2,
            ),
            212 => 
            array (
                'permission_id' => 149,
                'role_id' => 2,
            ),
            213 => 
            array (
                'permission_id' => 151,
                'role_id' => 2,
            ),
            214 =>
                array(
                    'permission_id' => 151,
                    'role_id' => 3,
                ),
            215 => 
            array (
                'permission_id' => 152,
                'role_id' => 2,
            ),
            216 => 
            array (
                'permission_id' => 152,
                'role_id' => 3,
            ),
            217 => 
            array (
                'permission_id' => 153,
                'role_id' => 2,
            ),
            218 => 
            array (
                'permission_id' => 153,
                'role_id' => 3,
            ),
            219 => 
            array (
                'permission_id' => 155,
                'role_id' => 2,
            ),
            220 => 
            array (
                'permission_id' => 156,
                'role_id' => 2,
            ),
            221 => 
            array (
                'permission_id' => 160,
                'role_id' => 2,
            ),
            222 => 
            array (
                'permission_id' => 164,
                'role_id' => 2,
            ),
            223 => 
            array (
                'permission_id' => 164,
                'role_id' => 3,
            ),
            224 => 
            array (
                'permission_id' => 164,
                'role_id' => 4,
            ),
            225 => 
            array (
                'permission_id' => 164,
                'role_id' => 5,
            ),
            226 => 
            array (
                'permission_id' => 165,
                'role_id' => 2,
            ),
            227 => 
            array (
                'permission_id' => 166,
                'role_id' => 2,
            ),
            228 => 
            array (
                'permission_id' => 167,
                'role_id' => 2,
            ),
            229 => 
            array (
                'permission_id' => 168,
                'role_id' => 2,
            ),
            230 => 
            array (
                'permission_id' => 169,
                'role_id' => 2,
            ),
            231 =>
                array(
                    'permission_id' => 170,
                    'role_id' => 2,
                ),
            232 =>
                array(
                    'permission_id' => 170,
                    'role_id' => 3,
                ),
            233 =>
                array(
                    'permission_id' => 171,
                    'role_id' => 2,
                ),
            234 =>
                array(
                    'permission_id' => 171,
                    'role_id' => 3,
                ),
            235 =>
                array(
                    'permission_id' => 172,
                    'role_id' => 2,
                ),
            236 =>
                array(
                    'permission_id' => 172,
                    'role_id' => 3,
                ),
            237 =>
                array(
                    'permission_id' => 173,
                    'role_id' => 2,
                ),
            238 =>
                array(
                    'permission_id' => 174,
                    'role_id' => 2,
                ),
            239 =>
                array(
                    'permission_id' => 175,
                    'role_id' => 2,
                ),
            240 =>
                array(
                    'permission_id' => 176,
                    'role_id' => 2,
                ),
            241 =>
                array(
                    'permission_id' => 177,
                    'role_id' => 2,
                ),
            242 =>
                array(
                    'permission_id' => 31,
                    'role_id' => 3,
                ),
            243 =>
                array(
                    'permission_id' => 32,
                    'role_id' => 3,
                ),
            244 =>
                array(
                    'permission_id' => 31,
                    'role_id' => 4,
                ),
            245 =>
                array(
                    'permission_id' => 32,
                    'role_id' => 4,
                ),
            246 =>
                array(
                    'permission_id' => 182,
                    'role_id' => 2,
                ),
            247 =>
                array(
                    'permission_id' => 182,
                    'role_id' => 3,
                ),
            248 =>
                array(
                    'permission_id' => 182,
                    'role_id' => 4,
                ),
        ));
        
        
    }
}