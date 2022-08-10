<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Services\ShortLinkService;
use App\Specifications\LifetimeSpecification;
use App\Specifications\LimitSpecification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    public function index()
    {
        return view('shortlink', [
            'shortLinks' => ShortLink::query()->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'limit' => 'required|int',
            'lifetime' => 'required|date_format:H:i',
        ]);

        ShortLink::query()->create([
            'link' => $request->link,
            'code' => str_random(8),
            'limit' => $request->limit,
            'lifetime' => (new ShortLinkService)->prepareDate(Carbon::parse($request->lifetime))
        ]);

        return redirect()->route('generate.short.link');
    }

    public function getShortLink(string $code)
    {
        $link = ShortLink::where('code', $code)->firstOrFail();

        $limitSpecification = (new LimitSpecification())->isSatisfiedBy($link);
        $lifetimeSpecification = (new LifetimeSpecification())->isSatisfiedBy($link);

        if (!$limitSpecification || !$lifetimeSpecification) {
            return view('404');
        }
        $link->count++;
        $link->save();

        return redirect($link->link);
    }
}
