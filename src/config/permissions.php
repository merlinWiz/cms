<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 20.03.2015
 */
return [

    'rules'         => [
        [
            'class' => \skeeks\cms\rbac\AuthorRule::className(),
        ]
    ],

    'roles'         => [

        [
            'name'          => \skeeks\cms\rbac\CmsManager::ROLE_ROOT,
            'description'   => \Yii::t('skeeks/cms','Superuser'),
        ],

        [
            'name'          => \skeeks\cms\rbac\CmsManager::ROLE_GUEST,
            'description'   => \Yii::t('skeeks/cms','Unauthorized user'),
        ],

        [
            'name'          => \skeeks\cms\rbac\CmsManager::ROLE_ADMIN,
            'description'   => \Yii::t('skeeks/cms','Admin'),

            'child'         =>
            [
                //Обладает возможностями всех ролей
                /*'roles' =>
                [
                    \skeeks\cms\rbac\CmsManager::ROLE_MANGER,
                    \skeeks\cms\rbac\CmsManager::ROLE_EDITOR,
                    \skeeks\cms\rbac\CmsManager::ROLE_USER,
                ],*/

                //Есть доступ к системе администрирования
                'permissions' =>
                [
                    \skeeks\cms\rbac\CmsManager::PERMISSION_ADMIN_ACCESS,
                    \skeeks\cms\rbac\CmsManager::PERMISSION_CONTROLL_PANEL,

                    \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_USER_FILES,
                    \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_COMMON_PUBLIC_FILES,
                    \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_ADDITIONAL_FILES,
                ],
            ]
        ],

        [
            'name'          => \skeeks\cms\rbac\CmsManager::ROLE_MANGER,
            'description'   => \Yii::t('skeeks/cms','Manager (access to the administration)'),

            'child'         =>
            [
                //Обладает возможностями всех ролей
                /*'roles' =>
                [
                    \skeeks\cms\rbac\CmsManager::ROLE_EDITOR,
                    \skeeks\cms\rbac\CmsManager::ROLE_USER,
                ],*/

                //Есть доступ к системе администрирования
                'permissions' =>
                [
                    \skeeks\cms\rbac\CmsManager::PERMISSION_ADMIN_ACCESS,
                    \skeeks\cms\rbac\CmsManager::PERMISSION_CONTROLL_PANEL,

                    \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_USER_FILES,
                    \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_COMMON_PUBLIC_FILES,
                ],
            ]
        ],

        [
            'name'          => \skeeks\cms\rbac\CmsManager::ROLE_EDITOR,
            'description'   => \Yii::t('skeeks/cms','Editor (access to the administration)'),

            'child'         =>
            [
                //Обладает возможностями всех ролей
                /*'roles' =>
                [
                    \skeeks\cms\rbac\CmsManager::ROLE_USER,
                ],*/

                //Есть доступ к системе администрирования
                'permissions' =>
                [
                    \skeeks\cms\rbac\CmsManager::PERMISSION_ADMIN_ACCESS,
                    \skeeks\cms\rbac\CmsManager::PERMISSION_CONTROLL_PANEL,

                    \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_USER_FILES,
                    \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_COMMON_PUBLIC_FILES,
                ],
            ]
        ],

        [
            'name'          => \skeeks\cms\rbac\CmsManager::ROLE_USER,
            'description'   => \Yii::t('skeeks/cms','Registered user'),

            //Есть доступ к системе администрирования
            'permissions' =>
            [
                \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_USER_FILES,
            ],
        ],

        [
            'name'          => \skeeks\cms\rbac\CmsManager::ROLE_APPROVED,
            'description'   => \Yii::t('skeeks/cms','Confirmed user'),

            //Есть доступ к системе администрирования
            'permissions' =>
            [
                \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_USER_FILES,
            ],
        ]
    ],

    'permissions'   => [
        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_ADMIN_ACCESS,
            'description'   => \Yii::t('skeeks/cms','Access to system administration')
        ],

        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_CONTROLL_PANEL,
            'description'   => \Yii::t('skeeks/cms','Access to the site control panel')
        ],

        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_ALLOW_MODEL_CREATE,
            'description'   => \Yii::t('skeeks/cms','The ability to create records')
        ],

        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_EDIT_VIEW_FILES,
            'description'   => \Yii::t('skeeks/cms','The ability to edit view files')
        ],


        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_USER_FILES,
            'description'   => \Yii::t('skeeks/cms','Access to personal files')
        ],

        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_COMMON_PUBLIC_FILES,
            'description'   => \Yii::t('skeeks/cms','Access to the public files')
        ],

        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_ELFINDER_ADDITIONAL_FILES,
            'description'   => \Yii::t('skeeks/cms','Access to all files')
        ],

        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_ADMIN_DASHBOARDS_EDIT,
            'description'   => \Yii::t('skeeks/cms','Access to edit dashboards')
        ],

        [
            'name' => \skeeks\cms\rbac\CmsManager::PERMISSION_USER_FULL_EDIT,
            'description'   => \Yii::t('skeeks/cms','The ability to manage user groups')
        ],
    ],


];