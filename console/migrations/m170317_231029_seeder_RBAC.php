<?php

class m170317_231029_seeder_RBAC extends \yii\db\Migration
{
    public function up()
    {
        $user = \common\models\User::findByUsername('admin');
        $user->id ?? 1;
        $role = "UserController_".$user->id;
        if (!Yii::$app->authManager->getRole($role)) {
            $permissionsCollection = [
                "index",
                "create",
                "view",
                "update"
            ];
            $this->insert("auth_item", [
                "name" => $role,
                "type" => 1,
                "description" => "role_".$role,
                "rule_name" => null,
                "data" => null,
                "created_at" => time(),
                "updated_at" => time()
            ]);
            foreach ($permissionsCollection as $permission) {
                $this->insert("auth_item", [
                    "name" => $permission,
                    "type" => 2,
                    "description" => "permission_".$permission,
                    "rule_name" => null,
                    "data" => null,
                    "created_at" => time(),
                    "updated_at" => time()
                ]);
                $this->insert("auth_item_child", [
                    "parent" => $role,
                    "child" => $permission
                ]);
            }
            $this->insert("auth_assignment", [
                "item_name" => $role,
                "user_id" => $user->id,
                "created_at" => time(),
            ]);
        }
        return 0;
    }

    public function down()
    {
        echo "m170317_231029_seeder_RBAC cannot be reverted.\n";

        return false;
    }
}
