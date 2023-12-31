<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use File;

class TeamController extends Controller
{
    public function index()
    {
       $searchTerm = request()->get('s');
        $teams = Team::Latest()->where('fullname', 'LIKE', "%$searchTerm%")->paginate(15);
        return view('admin.team.index')
            ->with(compact('teams'));
    }
    public function create()
    {
    	return view('admin.team.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'designation' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'profile' => 'required',
            'team_img' => 'required|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $fileName = null;
        if (request()->hasFile('team_img')) 
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        Team::create([
            'fullname' => $request->get('fullname'),
            'designation' => $request->get('designation'),
            'telephone' => $request->get('telephone'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
            'facebook_id' => $request->get('facebook_id'),
            'twitter_id' => $request->get('twitter_id'),
            'pinterest_id' => $request->get('pinterest_id'),
            'profile' => $request->get('profile'),
            'team_img' => $fileName,
            'status' => 'ACTIVE',
        ]);
        return redirect()->to('admin/team');
    }
    public function edit($id)
    {
        $team = Team::findOrfail($id);
    	return view('admin.team.edit')
            ->with(compact('team'));
    }
    public function update(Request $request, $id)
    {
        $team = Team::findOrfail($id);
        $currentImage = $team->team_img;

        $fileName = null;
        if (request()->hasFile('team_img')) 
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $team->update([
            'fullname' => $request->get('fullname'),
            'designation' => $request->get('designation'),
            'telephone' => $request->get('telephone'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
            'facebook_id' => $request->get('facebook_id'),
            'twitter_id' => $request->get('twitter_id'),
            'pinterest_id' => $request->get('pinterest_id'),
            'profile' => '100',
            'team_img' => ($fileName) ? $fileName : $currentImage,
            'status' => 'ACTIVE',
        ]);
        if ($fileName)
            File::delete('./uploads/'. $currentImage);

        return redirect()->to('/admin/team');
    }
     public function delete(Request $request, $id)
    {
        if ($request->ajax()) 
        {
        $team = Team::findOrfail($id);
        $currentImage = $team->team_img;
        $team->delete();
        File::delete('./uploads/' . $currentImage);
        return 'true';
        }
    }
    public function status(Request $request, $id)
    {
        sleep(0.5);
        if($request->ajax())
        $team = Team::findOrFail($id);
        $newStatus = ($team->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $team->update([
            'status' => $newStatus
        ]);
        echo $newStatus;
    }
}
