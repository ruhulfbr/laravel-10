<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPodcast;
use App\Models\Podcast;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

//use App\Jobs\OptimizePodcast;
//use App\Jobs\ProcessPodcast;
//use App\Jobs\ReleasePodcast;
use Illuminate\Support\Facades\Bus;

class PodcastController extends Controller
{
    /**
     * Store a new podcast.
     */
    public function store(Request $request): RedirectResponse
    {
        $podcast = Podcast::create(/* ... */);

        // ...

//        ProcessPodcast::dispatch($podcast);

//        ProcessPodcast::dispatchIf($accountActive, $podcast);
//        ProcessPodcast::dispatchUnless($accountSuspended, $podcast);

        ProcessPodcast::dispatch($podcast)->delay(now()->addMinutes(10));

//        ProcessPodcast::dispatchAfterResponse();
//        ProcessPodcast::dispatchSync($podcast);
//        ProcessPodcast::dispatch($podcast)->afterCommit();
//        ProcessPodcast::dispatch($podcast)->beforeCommit();
//

//        Bus::chain([
//            new ProcessPodcast,
//            new OptimizePodcast,
//            new ReleasePodcast,
//        ])->dispatch();

//        Bus::chain([
//            new ProcessPodcast,
//            new OptimizePodcast,
//            function () {
//                Podcast::update(/* ... */);
//            },
//        ])->dispatch();

//        Bus::chain([
//            new ProcessPodcast,
//            new OptimizePodcast,
//            new ReleasePodcast,
//        ])->onConnection('redis')->onQueue('podcasts')->dispatch();

        return redirect('/podcasts');
    }
}
