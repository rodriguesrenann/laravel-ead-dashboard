<?php

namespace App\Enums\Support;

enum SupportEnum: string
{
    case A = 'Aguardando aluno';
    case P = 'Pendente';
    case C = 'Finalizado';
}
