<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Labels Model
 *
 * @method \App\Model\Entity\Label newEmptyEntity()
 * @method \App\Model\Entity\Label newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Label> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Label get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Label findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Label patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Label> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Label|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Label saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Label>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Label>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Label>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Label> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Label>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Label>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Label>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Label> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LabelsTable extends Table
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

        $this->setTable('labels');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
