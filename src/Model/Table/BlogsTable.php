<?php
namespace App\Model\Table;

use App\Model\Entity\Blog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Categories
 */
class BlogsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('blog');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Authors', [
            'className' => 'Users',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
            'className' => 'Categories',
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'blog_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('title', __('The blog title is required!'));
        $validator->notEmpty('body', __('Your body has to have at least 5 characters'));
        $validator->notEmpty('category_id', __('No category is selected'));
        $validator->allowEmpty('tags', __('Tags can be empty'));
        $validator->notEmpty('status', __('You did not give up a status'));

        $validator->notEmpty('comment_body', __('The comment can not be left empty'));

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Authors'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        return $rules;
    }

    public function isOwnedBy($articleId, $userId)
    {
        return $this->exists(['id' => $articleId, 'user_id' => $userId]);
    }
}
