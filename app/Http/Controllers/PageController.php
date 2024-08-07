<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homePage()
    {
        $galleries = Gallery::all();
        $projects = Project::all();
        $clients = Client::all();
        return view('welcome', compact('galleries','clients','projects'));
    }

    public function projectHomePage()
    {
        $projects = Project::all();
        $abouts = About::all();
        $clients = Client::all();
        $tags = Tag::whereHas('projects')->get();
        $services = Service::all();
        $galleries = Gallery::all();
        return view('projects', compact('projects', 'abouts', 'clients', 'tags', 'services', 'galleries'));
    }

    public function aboutHomePage()
    {
        $projects = Project::all();
        $abouts = About::all();
        $clients = Client::all();
        $tags = Tag::whereHas('projects')->get();
        $services = Service::all();
        $galleries = Gallery::all();
        return view('about', compact('abouts', 'abouts', 'clients', 'tags', 'services', 'galleries'));
    }

    public function contactHomePage()
    {
        $projects = Project::all();
        $abouts = About::all();
        $clients = Client::all();
        $tags = Tag::whereHas('projects')->get();
        $services = Service::all();
        $galleries = Gallery::all();
        return view('contact', compact('abouts', 'clients', 'tags', 'services', 'galleries'));
    }

    public function serviceHomePage()
    {
        $projects = Project::all();
        $abouts = About::all();
        $clients = Client::all();
        $tags = Tag::whereHas('projects')->get();
        $services = Service::all();
        $galleries = Gallery::all();
        return view('services', compact('projects', 'abouts', 'clients', 'tags', 'services', 'galleries'));
    }

    public function clientHomePage()
    {
        $projects = Project::all();
        $abouts = About::all();
        $clients = Client::all();
        $tags = Tag::whereHas('projects')->get();
        $services = Service::all();
        $galleries = Gallery::all();
        return view('client', compact('clients', 'abouts', 'clients', 'tags', 'services', 'galleries'));
    }

    public function projectPage($id)
    {
        $project = Project::find($id);
        $projects = Project::all();
        $tags = Tag::all();
        return view('project', compact('project','projects','tags'));
    }

    public function servicePage($id)
    {
        $service = Service::find($id);
        $services = Service::all();
        return view('service', compact('service', 'services'));
    }
}
