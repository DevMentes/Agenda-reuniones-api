<?php

namespace Babilonia\Context\Agenda\Application\Services\RestrictsTimes;

use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHour;
use Babilonia\Context\Agenda\Domain\User\PublicUser;
use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHourRepository;
use Babilonia\Infrastructure\Uuid\UuidGenerator;

class RestrictsTimeService
{

    private $restrictedHourRepository;

    public function __construct(RestrictedHourRepository $restrictedHourRepository)
    {
        $this->restrictedHourRepository = $restrictedHourRepository;
    }

    public function execute(RestrictsTimeRequest $request)
    {
        $publicUser = new PublicUser(
            $request->user()['id'],
            $request->user()['name'],
            $request->user()['surnames'],
            $request->user()['email']
        );

        $weekdays = $request->weekdays();
        $startAt = $request->startAt();
        $finishAt = $request->finishAt();

        foreach ($weekdays as $weekday){
            $this->restrictedHourRepository->restrict(
                new RestrictedHour(
                    UuidGenerator::generate(),
                    $publicUser,
                    $weekday,
                    $startAt,
                    $finishAt
                )
            );
        }
    }
}