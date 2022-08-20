<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // get all tasks for datatable
    public function index(Request $request)
    {
        $draw = $request->get('draw'); //for datatable
        $start = $request->get("start"); //for paginated
        $search = $request->get('search'); //for Search
        $rowPerPage = $request->get("length",10); // total number of rows per page
        $searchValue = $request->has('search') ? $search['value'] : null; // Search value

        // Total records
        $totalRecords = Task::query()->count();
        $totalRecordsWithFilter = Task::where('title', 'LIKE', '%' . $searchValue . '%')->count();

        // Get tasks with a search filter as well
        $records = Task::where(function ($query) use ($searchValue) {
            if($searchValue){
                $query->where('title', 'like', '%' . $searchValue . '%');
            }
        })
            ->join('users as admin','admin.id','=','tasks.assigned_to_id')
            ->join('users as users','users.id','=','tasks.assigned_to_id')
            ->select('tasks.id','tasks.title','tasks.description','admin.name as admin_name','users.name as user_name','tasks.created_at')
            ->skip($start)
            ->take($rowPerPage)
            ->latest()
            ->get();

        //the response must like as Datatable needs it
        //https://datatables.net/examples/server_side/pipeline.html
        return [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData" => $records->toArray(),
        ];

    }
}
