<?php

use yii\db\Migration;
use app\models\User;
/**
 * Class m240817_094323_add_admin_user
 */
class m240817_094323_add_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Create 'admin' role if it does not exist
        $adminRole = $auth->getRole('admin');
        if ($adminRole === null) {
            $adminRole = $auth->createRole('admin');
            $auth->add($adminRole);
        }

        // Create 'admin' user
        $this->insert('user', [
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin_password'), // Use a strong password
            'email' => 'admin@example.com',
            'phone_number' => '1234567890',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'access_token' => Yii::$app->security->generateRandomString(),
            'refresh_token' => Yii::$app->security->generateRandomString(),
            'status' => 10,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Get the user ID of the newly created admin user
        $userId = $this->db->getLastInsertID();

        // Assign 'admin' role to the newly created user
        $auth->assign($adminRole, $userId);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove the 'admin' role assignment
        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole('admin');
        if ($adminRole !== null) {
            $user = User::findOne(['username' => 'admin']);
            if ($user !== null) {
                $auth->revoke($adminRole, $user->getId());
            }
            $auth->remove($adminRole);
        }

        // Remove the 'admin' user
        $this->delete('user', ['username' => 'admin']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240817_094323_add_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
