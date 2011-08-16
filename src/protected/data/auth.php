<?php
return array(
	// roles
	'admin' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'administrators',
		'children' => array(
			'op_create_forum',
		),
		'assignments' => array(
			'knut' => array(
				'bizRule' => null,
				'data' => null,
			),
		),
		'bizRule' => null,
		'data' => null,
	),
	// operations
	'op_create_forum' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'create a new forum',
		'bizRule' => null,
		'data' => null,
	),
	// tasks
	'task_create_forum' => array(
		'type' => CAuthItem::TYPE_TASK,
		'description' => 'create a new forum',
		'bizRule' => null,
		'data' => null,
	),
);
