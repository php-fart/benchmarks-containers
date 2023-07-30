<?php

declare(strict_types=1);

namespace App\Feature\Case;

use App\Feature\Attribute\CaseMethod;
use App\Feature\Attribute\Description;
use App\Feature\Binding;
use App\Feature\Exception\WrongBehavior;
use App\Feature\State\ContainerState;
use App\Feature\Stub\EmptyClass;

final class Singleton extends BaseCase
{
    #[CaseMethod]
    #[Description('Simple singleton resolving')]
    public function getSingleton(ContainerState $state): void
    {
        $id = EmptyClass::class;
        $state->singleton($id, Binding\ClassName::new(EmptyClass::class));

        $c = $state->build();

        $first = $c->get($id);

        $this->checkBehavior($c->get($id) === $first, 'Singletons are always the same');
    }
}
