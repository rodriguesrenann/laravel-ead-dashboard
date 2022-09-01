<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Str;

class LessonObserver
{
    /**
     * Handle the Lesson "creating" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function creating(Lesson $lesson)
    {
        $lesson->url = Str::slug($lesson->name);
    }

    /**
     * Handle the Lesson "updating" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function updating(Lesson $lesson)
    {
        $lesson->url = Str::slug($lesson->name);
    }

    /**
     * Handle the Lesson "deleted" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function deleted(Lesson $lesson)
    {
        //
    }

    /**
     * Handle the Lesson "restored" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function restored(Lesson $lesson)
    {
        //
    }

    /**
     * Handle the Lesson "force deleted" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function forceDeleted(Lesson $lesson)
    {
        //
    }
}
