<?php
namespace App\Model\Table;

use App\Model\Entity\ProfileMessage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfileMessages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profiles
 * @property \Cake\ORM\Association\BelongsTo $Posters
 */
class ProfileMessagesTable extends Table
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

        $this->table('profile_messages');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Profiles', [
            'className' => 'Users',
            'foreignKey' => 'profile_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Posters', [
            'className' => 'Users',
            'foreignKey' => 'poster_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'className' => 'Users',
            'foreignKey' => 'poster_id',
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
        $validator->requirePresence('message', __('A message is required'));
        $validator->requirePresence('poster_id', __('A poster is required'));
        $validator->requirePresence('profile_id', __('A profile is required'));

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
        $rules->add($rules->existsIn(['profile_id'], 'Profiles'));
        $rules->add($rules->existsIn(['poster_id'], 'Posters'));
        return $rules;
    }
}
