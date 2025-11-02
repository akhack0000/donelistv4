<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dones Model
 *
 * @property \App\Model\Table\LabelsTable&\Cake\ORM\Association\BelongsTo $Labels
 *
 * @method \App\Model\Entity\Done newEmptyEntity()
 * @method \App\Model\Entity\Done newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Done> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Done get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Done findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Done patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Done> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Done|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Done saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Done>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Done>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Done>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Done> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Done>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Done>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Done>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Done> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DonesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('dones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Labels', [
            'foreignKey' => 'label_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('label_id')
            ->notEmptyString('label_id');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['label_id'], 'Labels'), ['errorField' => 'label_id']);

        return $rules;
    }
}
