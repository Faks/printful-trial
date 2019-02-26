<?php


use Phinx\Migration\AbstractMigration;

class UserQuizQuestionsAnswers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        $table = $this->table('user_quiz_question_answer');
        $table->addColumn('quiz_id', 'integer', ['default' => 0])
            ->addColumn('quiz_question_id', 'integer', ['default' => 0])
            ->addColumn('quiz_question_answer_id', 'integer', ['default' => 0])
            ->addColumn('user_quiz_sign_up_id', 'integer', ['default' => 0])
            ->addColumn('user_quiz_question_answer', 'string', ['limit' => 255])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();
    }
}
