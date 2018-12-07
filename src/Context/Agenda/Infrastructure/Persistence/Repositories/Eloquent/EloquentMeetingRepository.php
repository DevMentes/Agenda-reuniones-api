<?php

namespace Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent;

use Babilonia\Context\Agenda\Domain\Meeting\BasicMeetingData;
use Babilonia\Context\Agenda\Domain\Meeting\Meeting;
use Babilonia\Context\Agenda\Domain\User\PublicUser;
use Babilonia\Context\Agenda\Domain\Meeting\MeetingRepository;
use Babilonia\Context\Agenda\Infrastructure\Exceptions\UserNotFoundException;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Models\Eloquent\EloquentUser;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Models\Eloquent\EloquentMeeting;

class EloquentMeetingRepository implements MeetingRepository
{

    public function userHasMeetingInDate(PublicUser $publicUser, string $date, string $startAt, string $finishAt): bool
    {
        $eloquentUser = EloquentUser::find($publicUser->id());

        if ($eloquentUser === null){
            throw new UserNotFoundException();
        }

        return !$eloquentUser->meetings()
            ->where('date', $date)
            ->where('start_at', '>=', $startAt)
            ->where('start_at', '<=', $finishAt)
            ->orWhere('finish_at', '>=', $startAt)
            ->where('finish_at', '<=', $finishAt)
            ->exists();
    }

    public function schedule(Meeting $newMeeting): void
    {
        $eloquentMeeting = new EloquentMeeting();
        $eloquentMeeting->id = $newMeeting->id();
        $eloquentMeeting->date = $newMeeting->date();
        $eloquentMeeting->start_at = $newMeeting->startAt();
        $eloquentMeeting->finish_at = $newMeeting->finishAt();

        $eloquentMeeting->save();

        $organizer = $newMeeting->organizer();
        $guests = $newMeeting->guests();

        $eloquentMeeting->users()->attach($organizer->id(), ['role' => 0]);

        foreach ($guests as $guest){
            $eloquentMeeting->users()->attach($guest->id());
        }
    }

    public function forMonth(PublicUser $publicUser, int $year, int $month): array
    {
        $eloquentUser = EloquentUser::find($publicUser->id());

        $eloquentMeetings = $eloquentUser->meetings()->whereRaw('MONTH(date) = ' . $month)->get();

        $meetings = array();

        foreach ($eloquentMeetings as $eloquentMeeting){
            $meetings [] = new BasicMeetingData(
                $eloquentMeeting->id,
                $eloquentMeeting->date,
                $eloquentMeeting->start_at,
                $eloquentMeeting->finish_at
            );
        }

        return $meetings;
    }
}