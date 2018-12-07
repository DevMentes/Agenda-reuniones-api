<?php

namespace Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent;

use Babilonia\Context\Agenda\Domain\User\PublicUser;
use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHour;
use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHourRepository;
use Babilonia\Context\Agenda\Infrastructure\Exceptions\UserNotFoundException;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Models\Eloquent\EloquentRestrictedHour;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Models\Eloquent\EloquentUser;

class EloquentRestrictedHourRepository implements RestrictedHourRepository
{

    public function userHasRestrictedHoursInDate(PublicUser $publicUser, string $weekday, string $startAt, string $finishAt): bool
    {
        $eloquentUser = EloquentUser::find($publicUser->id());

        if ($eloquentUser === null){
            throw new UserNotFoundException();
        }

        return !$eloquentUser->restrictedHours()
            ->where('weekday', $weekday)
            ->where('start_at', '>=', $startAt)
            ->where('start_at', '<=', $finishAt)
            ->orWhere('finish_at', '>=', $startAt)
            ->where('finish_at', '<=', $finishAt)
            ->exists();
    }

    public function restrict(RestrictedHour $restrictedHour): void
    {
        $eloquentRestrictedHour = new EloquentRestrictedHour();

        $eloquentRestrictedHour->id = $restrictedHour->id();
        $eloquentRestrictedHour->user_id = $restrictedHour->user()->id();
        $eloquentRestrictedHour->weekday = $restrictedHour->weekday();
        $eloquentRestrictedHour->start_at = $restrictedHour->startAt();
        $eloquentRestrictedHour->finish_at = $restrictedHour->finishAt();

        try{
            $eloquentRestrictedHour->save();
        }catch(\Exception $exception){
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }

    }

    public function week(PublicUser $user):array
    {
        $eloquentRestrictedHours = EloquentRestrictedHour::where('user_id', $user->id())->get();

        $restrictedHours = array();

        foreach ($eloquentRestrictedHours as $eloquentRestrictedHour){
            $restrictedHours [] = new RestrictedHour(
                $eloquentRestrictedHour->id,
                $user,
                $eloquentRestrictedHour->weekday,
                $eloquentRestrictedHour->start_at,
                $eloquentRestrictedHour->finish_at
            );
        }

        return $restrictedHours;
    }
}