Dekalee/NightlyTaskBundle
=========================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dekalee/nightly-task-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dekalee/nightly-task-bundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dekalee/nightly-task-bundle/v/stable)](https://packagist.org/packages/dekalee/nightly-task-bundle)
[![Total Downloads](https://poser.pugx.org/dekalee/nightly-task-bundle/downloads)](https://packagist.org/packages/dekalee/nightly-task-bundle)
[![License](https://poser.pugx.org/dekalee/nightly-task-bundle/license)](https://packagist.org/packages/dekalee/nightly-task-bundle)

This bundle will launch all the configured nightly task.

Installation
------------

Use composer to install the bundle

```bash
    $ composer require dekalee/nightly-task-bundle
```

If you are not using symfony4 you should activate the bundle in your
`AppKernel.php` file.

```php
    new Dekalee\NightlyTaskBundle\DekaleeNightlyTaskBundle(),
```

Usage
-----

### List commands

To list all the commands register as nightly task command run

```bash
    $ ./bin/console dekalee:nightly:list
```

### Launch commands

To launch the nigthly tasks, run the command :

```bash
    $ ./bin/console dekalee:nightly:tasks
```

### Define a command as nightly tasks

#### With an interface

To define a command as a nigthly task, it should implement the
`Dekalee\NightlyTaskBundle\Command\NightlyCommandInterface` interface.

This interface will expose two methods:

 - `getPriority` will define the order in which the command should be run.
 Higher priority wins.
 - `isEssential` will determine if the nighty task command should fail
 if this particular command fails.

#### With a tag

It is also possible to transform a command in a nightly task by tagging
the service directly.

```yaml
   tags:
       - { name: console.command }
       - { name: dekalee_nightly.task.strategy, priority: 100 }
```

Your service should be defined as a command and then defined as a nightly
task with a priority.

It is not possible to make those kind of command essential.
