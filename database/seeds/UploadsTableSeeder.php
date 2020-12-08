<?php

use Illuminate\Database\Seeder;

class UploadsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('uploads')->delete();
        /*
        \DB::table('uploads')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => '457f0cfb-58d1-4fa4-98b8-7fed8462c22d',
                'created_at' => '2020-04-07 14:22:50',
                'updated_at' => '2020-04-07 14:22:50',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => 'adb5fa05-0159-45ec-98c0-bda917d4615b',
                'created_at' => '2020-04-07 14:22:50',
                'updated_at' => '2020-04-07 14:22:50',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => '25410b9b-3af9-40c8-a132-3eead8e17ad6',
                'created_at' => '2020-04-07 14:22:53',
                'updated_at' => '2020-04-07 14:22:53',
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => 'b926b17d-4d52-4658-848a-687afd30835a',
                'created_at' => '2020-04-07 14:22:53',
                'updated_at' => '2020-04-07 14:22:53',
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => 'd3f940ef-1032-4bcd-95f3-b6f23e3b922f',
                'created_at' => '2020-04-07 14:22:55',
                'updated_at' => '2020-04-07 14:22:55',
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => 'e334c7f2-0015-42fe-b144-325583308648',
                'created_at' => '2020-04-07 14:22:55',
                'updated_at' => '2020-04-07 14:22:55',
            ),
            6 => 
            array (
                'id' => 7,
                'uuid' => '44f7174b-3a69-443c-b18d-fc482d10de13',
                'created_at' => '2020-04-07 14:22:56',
                'updated_at' => '2020-04-07 14:22:56',
            ),
            7 => 
            array (
                'id' => 8,
                'uuid' => '19b50e13-608d-4b4d-81df-9c5ba77378d3',
                'created_at' => '2020-04-07 14:22:57',
                'updated_at' => '2020-04-07 14:22:57',
            ),
            8 => 
            array (
                'id' => 9,
                'uuid' => 'a72c9f94-f831-4790-817a-e92777b6148a',
                'created_at' => '2020-04-07 14:22:58',
                'updated_at' => '2020-04-07 14:22:58',
            ),
            9 => 
            array (
                'id' => 10,
                'uuid' => 'f828c625-c4b1-4cce-b2c0-e448f2f95f3d',
                'created_at' => '2020-04-07 14:22:59',
                'updated_at' => '2020-04-07 14:22:59',
            ),
            10 => 
            array (
                'id' => 11,
                'uuid' => 'c1bb2512-9b4f-4e17-9a9a-1de14e3bf2bc',
                'created_at' => '2020-04-07 14:23:00',
                'updated_at' => '2020-04-07 14:23:00',
            ),
            11 => 
            array (
                'id' => 12,
                'uuid' => 'd1fda664-47ff-4e19-a135-af5b00ca5056',
                'created_at' => '2020-04-07 14:23:01',
                'updated_at' => '2020-04-07 14:23:01',
            ),
            12 => 
            array (
                'id' => 13,
                'uuid' => '0b467d04-ce93-446a-8a73-7cf8fcae7e5d',
                'created_at' => '2020-04-07 14:23:02',
                'updated_at' => '2020-04-07 14:23:02',
            ),
            13 => 
            array (
                'id' => 14,
                'uuid' => '509dd0f1-c04c-4ac6-a106-a84172ceb2be',
                'created_at' => '2020-04-07 14:23:02',
                'updated_at' => '2020-04-07 14:23:02',
            ),
            14 => 
            array (
                'id' => 15,
                'uuid' => '7fab2398-06b7-422d-b9a3-55ff4e44b1f1',
                'created_at' => '2020-04-07 14:23:03',
                'updated_at' => '2020-04-07 14:23:03',
            ),
            15 => 
            array (
                'id' => 16,
                'uuid' => 'dac192ba-a7fc-410b-9ff6-2adeda70a62c',
                'created_at' => '2020-04-07 14:23:04',
                'updated_at' => '2020-04-07 14:23:04',
            ),
            16 => 
            array (
                'id' => 17,
                'uuid' => 'dc615e70-01e3-4905-9437-46bc6a5726ac',
                'created_at' => '2020-04-07 14:23:05',
                'updated_at' => '2020-04-07 14:23:05',
            ),
            17 => 
            array (
                'id' => 18,
                'uuid' => 'b23df0ef-882f-4fe7-b840-3be6b4517086',
                'created_at' => '2020-04-07 14:23:05',
                'updated_at' => '2020-04-07 14:23:05',
            ),
            18 => 
            array (
                'id' => 19,
                'uuid' => 'a56c5126-76a6-4da8-bec9-40784a9b81d5',
                'created_at' => '2020-04-07 14:23:06',
                'updated_at' => '2020-04-07 14:23:06',
            ),
            19 => 
            array (
                'id' => 20,
                'uuid' => 'e34d9f9d-183a-4f3c-a851-b237bea5d92c',
                'created_at' => '2020-04-07 14:23:06',
                'updated_at' => '2020-04-07 14:23:06',
            ),
            20 => 
            array (
                'id' => 21,
                'uuid' => '1a4d93a1-d5aa-4733-b32d-b57fed53bcea',
                'created_at' => '2020-04-07 14:23:07',
                'updated_at' => '2020-04-07 14:23:07',
            ),
            21 => 
            array (
                'id' => 22,
                'uuid' => '08280e48-85fc-4795-b81a-ce5bed2a5d84',
                'created_at' => '2020-04-07 14:23:07',
                'updated_at' => '2020-04-07 14:23:07',
            ),
            22 => 
            array (
                'id' => 23,
                'uuid' => '2459f16e-14a2-4f8a-98a1-6ab256590f3c',
                'created_at' => '2020-04-07 14:23:09',
                'updated_at' => '2020-04-07 14:23:09',
            ),
            23 => 
            array (
                'id' => 24,
                'uuid' => 'caa9d61d-fafe-4c72-bc33-1c446598e2b6',
                'created_at' => '2020-04-07 14:23:09',
                'updated_at' => '2020-04-07 14:23:09',
            ),
            24 => 
            array (
                'id' => 25,
                'uuid' => '47fc3c38-585e-48fe-b8f2-a8b43a825c2b',
                'created_at' => '2020-04-07 14:23:11',
                'updated_at' => '2020-04-07 14:23:11',
            ),
            25 => 
            array (
                'id' => 26,
                'uuid' => '1996ff68-fb76-4967-aa38-1dde6a07c7ec',
                'created_at' => '2020-04-07 14:23:11',
                'updated_at' => '2020-04-07 14:23:11',
            ),
            26 => 
            array (
                'id' => 27,
                'uuid' => '45e731a3-c00b-4a83-a51a-8dc2576bf117',
                'created_at' => '2020-04-07 14:23:12',
                'updated_at' => '2020-04-07 14:23:12',
            ),
            27 => 
            array (
                'id' => 28,
                'uuid' => '368e9b08-534c-4242-964a-812ae7147746',
                'created_at' => '2020-04-07 14:23:12',
                'updated_at' => '2020-04-07 14:23:12',
            ),
            28 => 
            array (
                'id' => 29,
                'uuid' => '5015a9a0-829d-4c61-9c0c-b2eb12c9f75d',
                'created_at' => '2020-04-07 14:23:42',
                'updated_at' => '2020-04-07 14:23:42',
            ),
            29 => 
            array (
                'id' => 30,
                'uuid' => '22001f4b-e743-4c66-a466-ed5a638ea51b',
                'created_at' => '2020-04-07 14:23:42',
                'updated_at' => '2020-04-07 14:23:42',
            ),
            30 => 
            array (
                'id' => 32,
                'uuid' => '7fda7a27-946a-43dd-b61d-23bad2db9aa3',
                'created_at' => '2020-04-07 14:23:43',
                'updated_at' => '2020-04-07 14:23:43',
            ),
            31 => 
            array (
                'id' => 33,
                'uuid' => 'ad1eecae-e272-4576-8eec-f93dcb335e94',
                'created_at' => '2020-04-07 14:23:45',
                'updated_at' => '2020-04-07 14:23:45',
            ),
            32 => 
            array (
                'id' => 35,
                'uuid' => 'ee7e3aa4-0e43-4d7d-9a5f-6e9f2dd2b48d',
                'created_at' => '2020-04-07 14:23:48',
                'updated_at' => '2020-04-07 14:23:48',
            ),
            33 => 
            array (
                'id' => 37,
                'uuid' => 'aef4f0d0-66e0-4aee-9ede-36e64d04aaec',
                'created_at' => '2020-04-07 14:23:50',
                'updated_at' => '2020-04-07 14:23:50',
            ),
            34 => 
            array (
                'id' => 40,
                'uuid' => '23f29571-f7ce-4fdc-ad70-140e0cc2e818',
                'created_at' => '2020-04-07 14:23:53',
                'updated_at' => '2020-04-07 14:23:53',
            ),
            35 => 
            array (
                'id' => 41,
                'uuid' => '52477b3e-8752-44ff-9451-bc60f54f96d7',
                'created_at' => '2020-04-07 14:23:54',
                'updated_at' => '2020-04-07 14:23:54',
            ),
            36 => 
            array (
                'id' => 42,
                'uuid' => 'e24b9e69-203a-489c-9bca-3585043b8bb7',
                'created_at' => '2020-04-07 14:23:54',
                'updated_at' => '2020-04-07 14:23:54',
            ),
            37 => 
            array (
                'id' => 43,
                'uuid' => '444cc685-1573-44ca-bfd7-0a7a0d2dac63',
                'created_at' => '2020-04-07 14:23:55',
                'updated_at' => '2020-04-07 14:23:55',
            ),
            38 => 
            array (
                'id' => 44,
                'uuid' => '4fc0ef87-cbc6-4634-957f-e9dea6c09985',
                'created_at' => '2020-04-07 14:23:56',
                'updated_at' => '2020-04-07 14:23:56',
            ),
            39 => 
            array (
                'id' => 45,
                'uuid' => 'af16c4d7-7bfd-49f7-9ab0-3263b8c0442c',
                'created_at' => '2020-04-07 14:23:57',
                'updated_at' => '2020-04-07 14:23:57',
            ),
            40 => 
            array (
                'id' => 46,
                'uuid' => 'c4d2b48d-7be5-409f-8661-f57aed3bb279',
                'created_at' => '2020-04-07 14:23:57',
                'updated_at' => '2020-04-07 14:23:57',
            ),
            41 => 
            array (
                'id' => 47,
                'uuid' => 'f3a11d6d-01d2-4655-b238-354a45aa836a',
                'created_at' => '2020-04-07 14:23:58',
                'updated_at' => '2020-04-07 14:23:58',
            ),
            42 => 
            array (
                'id' => 48,
                'uuid' => '0b1394a5-358e-48c9-bb63-fa13b59efbf8',
                'created_at' => '2020-04-07 14:23:59',
                'updated_at' => '2020-04-07 14:23:59',
            ),
            43 => 
            array (
                'id' => 49,
                'uuid' => '61c3fb45-1cbe-4a32-ad64-86fc7f643cd8',
                'created_at' => '2020-04-07 14:23:59',
                'updated_at' => '2020-04-07 14:23:59',
            ),
            44 => 
            array (
                'id' => 50,
                'uuid' => '2289008a-e6e3-4d85-ac4d-029d0da68069',
                'created_at' => '2020-04-07 14:24:00',
                'updated_at' => '2020-04-07 14:24:00',
            ),
            45 => 
            array (
                'id' => 51,
                'uuid' => '4b731edf-6051-4182-b51a-e8ed257fc2b8',
                'created_at' => '2020-04-07 14:24:01',
                'updated_at' => '2020-04-07 14:24:01',
            ),
            46 => 
            array (
                'id' => 52,
                'uuid' => 'eeb96384-50fc-4bcc-841c-f66a32b2901d',
                'created_at' => '2020-04-07 14:24:01',
                'updated_at' => '2020-04-07 14:24:01',
            ),
            47 => 
            array (
                'id' => 53,
                'uuid' => 'afdecdda-0803-4804-980d-9d65c467cd14',
                'created_at' => '2020-04-07 14:24:02',
                'updated_at' => '2020-04-07 14:24:02',
            ),
            48 => 
            array (
                'id' => 54,
                'uuid' => '7531cc43-42bb-4243-860a-2178d53877c5',
                'created_at' => '2020-04-07 14:24:02',
                'updated_at' => '2020-04-07 14:24:02',
            ),
            49 => 
            array (
                'id' => 55,
                'uuid' => '6e774b97-f8c6-4b7f-b1d2-5bf649c423e6',
                'created_at' => '2020-04-07 14:24:04',
                'updated_at' => '2020-04-07 14:24:04',
            ),
            50 => 
            array (
                'id' => 56,
                'uuid' => 'e5fb12e8-4943-48f8-a7ec-321e7b14fb57',
                'created_at' => '2020-04-07 14:24:04',
                'updated_at' => '2020-04-07 14:24:04',
            ),
            51 => 
            array (
                'id' => 57,
                'uuid' => 'a0f2ab66-c550-4c7d-93f0-4c7f235e539c',
                'created_at' => '2020-04-07 14:24:05',
                'updated_at' => '2020-04-07 14:24:05',
            ),
            52 => 
            array (
                'id' => 58,
                'uuid' => '0ac66a70-5d85-4744-b20f-fa815646cd41',
                'created_at' => '2020-04-07 14:24:05',
                'updated_at' => '2020-04-07 14:24:05',
            ),
            53 => 
            array (
                'id' => 59,
                'uuid' => '6eb84a57-cebf-4db8-8ffd-1155cf8a3d0a',
                'created_at' => '2020-04-07 14:24:06',
                'updated_at' => '2020-04-07 14:24:06',
            ),
            54 => 
            array (
                'id' => 60,
                'uuid' => 'fbf75935-335c-4de8-a7b4-66326d930cd7',
                'created_at' => '2020-04-07 14:24:07',
                'updated_at' => '2020-04-07 14:24:07',
            ),
            55 => 
            array (
                'id' => 61,
                'uuid' => '7de2300a-decc-484e-80af-92aea144d89d',
                'created_at' => '2020-04-07 14:24:07',
                'updated_at' => '2020-04-07 14:24:07',
            ),
            56 => 
            array (
                'id' => 62,
                'uuid' => '6dcc4319-5e01-4a1d-ab62-bb27cb396351',
                'created_at' => '2020-04-07 14:24:08',
                'updated_at' => '2020-04-07 14:24:08',
            ),
            57 => 
            array (
                'id' => 63,
                'uuid' => 'ed5064d6-0f61-4c06-833c-c091e95e81c5',
                'created_at' => '2020-04-07 14:24:08',
                'updated_at' => '2020-04-07 14:24:08',
            ),
            58 => 
            array (
                'id' => 64,
                'uuid' => 'a3412204-f36f-440c-b447-7d12f7192641',
                'created_at' => '2020-04-07 14:24:09',
                'updated_at' => '2020-04-07 14:24:09',
            ),
            59 => 
            array (
                'id' => 65,
                'uuid' => 'bc3ce793-8362-40df-8735-4b4e4ec7c5cc',
                'created_at' => '2020-04-07 14:25:30',
                'updated_at' => '2020-04-07 14:25:30',
            ),
            60 => 
            array (
                'id' => 66,
                'uuid' => '14a471db-180d-42f1-a16c-6af9cfe956fe',
                'created_at' => '2020-04-07 14:40:53',
                'updated_at' => '2020-04-07 14:40:53',
            ),
            61 => 
            array (
                'id' => 68,
                'uuid' => '0bf5ba45-823a-45b6-8796-1f441d44587f',
                'created_at' => '2020-04-07 14:55:55',
                'updated_at' => '2020-04-07 14:55:55',
            ),
            62 => 
            array (
                'id' => 69,
                'uuid' => '2f4aaef6-db74-4627-9442-dc9d5b6ace33',
                'created_at' => '2020-04-07 14:56:21',
                'updated_at' => '2020-04-07 14:56:21',
            ),
            63 => 
            array (
                'id' => 70,
                'uuid' => '379a0d22-ea2f-4a45-84c5-7e944f6bfbc1',
                'created_at' => '2020-04-07 14:56:36',
                'updated_at' => '2020-04-07 14:56:36',
            ),
            64 => 
            array (
                'id' => 71,
                'uuid' => 'f8b6d867-409f-4e31-9e5c-35ec7977a09e',
                'created_at' => '2020-04-07 14:56:50',
                'updated_at' => '2020-04-07 14:56:50',
            ),
            65 => 
            array (
                'id' => 72,
                'uuid' => '3b3562d1-8eec-4354-bdfd-aeb394c1b3b4',
                'created_at' => '2020-04-07 14:57:04',
                'updated_at' => '2020-04-07 14:57:04',
            ),
            66 => 
            array (
                'id' => 73,
                'uuid' => 'f9acd3f7-4aa5-41c1-a183-2835850c9745',
                'created_at' => '2020-04-07 14:57:24',
                'updated_at' => '2020-04-07 14:57:24',
            ),
        ));
        
        */
    }
}