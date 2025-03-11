<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class BanWord extends Constraint
{
    public const STRICT_MODE = 'strict';
    public const LOOSE_MODE = 'loose';

    public string $message = 'Le contenu contient un mot interdit : "{{ bannedWord }}"';
    public array $bannedWords = [
        'spam',
        'viagra',
        'casino',
        'porn',
        'porno',
        'sexe',
        'pute',
        'drogue',
        'arnaque',
        'hack',
        'bitcoin',
        'credit',
        'gamble',
        'phishing',
        'escroc'
    ];
    public string $mode = self::STRICT_MODE;

    public function __construct(
        string $mode = self::STRICT_MODE,
        ?array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct([], $groups, $payload);

        $this->bannedWords = $bannedWords ?? $this->bannedWords;
        $this->mode = $mode;
        $this->message = $message ?? $this->message;
    }

    public function getDefaultOption(): string
    {
        return 'bannedWords';
    }

    public function getRequiredOptions(): array
    {
        return ['bannedWords'];
    }

    public function validatedBy(): string
    {
        return BanWordValidator::class;
    }
}
