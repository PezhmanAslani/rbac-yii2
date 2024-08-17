<?php

use yii\db\Migration;

/**
 * Class m240817_074639_init_rbac
 */
class m240817_074639_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Create permissions
        $viewPost = $auth->createPermission('viewPost');
        $viewPost->description = 'View post';
        $auth->add($viewPost);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // Create roles
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $user = $auth->createRole('user');
        $auth->add($user);

        // Assign permissions to roles
        $auth->addChild($admin, $viewPost);
        $auth->addChild($admin, $updatePost);

        $auth->addChild($user, $viewPost);

        // Assign roles to users
        $auth->assign($admin, 1); // Assuming user with ID 1 is an admin
        $auth->assign($user, 2);  // Assuming user with ID 2 is a regular user
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        // Remove role assignments
        $auth->revoke($auth->getRole('admin'), 1);
        $auth->revoke($auth->getRole('user'), 2);

        // Remove roles
        $auth->remove($auth->getRole('admin'));
        $auth->remove($auth->getRole('user'));

        // Remove permissions
        $auth->remove($auth->getPermission('updatePost'));
        $auth->remove($auth->getPermission('viewPost'));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240817_074639_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
