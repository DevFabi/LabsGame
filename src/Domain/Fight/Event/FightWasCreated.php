<?php


namespace App\Domain\Fight\Event;


use App\Domain\Fight\ValueObject\GainLoss;
use App\Domain\Fight\ValueObject\Versus;
use App\Domain\Shared\ValueObject\DateTime;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;

class FightWasCreated implements Serializable
{

    /**
     * @throws \App\Domain\Shared\Exception\DateTimeException
     */
    public static function deserialize(array $data): self
    {
        return new self(
            Uuid::fromString($data['uuid']),
            $data['rules'],
            new GainLoss(
                $data['gainLoss']['amountGain'],
                $data['gainLoss']['amountLoss']
            ),
            new Versus(
                $data['versus']['firstOpponents'],
                $data['versus']['secondOpponents']),
            DateTime::fromString($data['created_at'])
        );
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->uuid,
            'rules' => $this->rules,
            'gainLoss' => [
                'amountGain' => $this->gainLoss->amountGain,
                'amountLoss' => $this->gainLoss->amountLoss,
            ],
            'versus' => [
                'firstOpponents' => $this->versus->firstOpponents,
                'secondOpponents' => $this->versus->secondOpponents,
            ],
            'created_at' => $this->createdAt->toString(),
        ];
    }

    public $uuid;

    public $rules;

    /** @var GainLoss */
    public $gainLoss;

    /** @var Versus */
    public $versus;

    /** @var DateTime */
    public $createdAt;

    public function __construct($uuid, $rules, GainLoss $gainLoss, Versus $versus, DateTime $createdAt)
    {
        $this->uuid = $uuid;
        $this->rules = $rules;
        $this->gainLoss = $gainLoss;
        $this->versus = $versus;
        $this->createdAt = $createdAt;
    }


}