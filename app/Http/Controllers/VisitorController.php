<?php

namespace App\Http\Controllers;

use App\ManagementLists;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

use App\Http\Requests;
use App\Models\Visitor;
use App\Myclass\PHPMailer;
use App\Myclass\SMTP;
use App\User;
use DataTables;
use Auth;

class VisitorController extends Controller
{

	public function __construct()
	{
		$this->middleware('permission:visitor-list|visitor-create|visitor-today|visitor-not_exit', ['only' => ['index', 'store', 'today', 'not_exit']]);
		$this->middleware('permission:visitor-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:visitor-today', ['only' => ['today']]);
		$this->middleware('permission:visitor-not_exit', ['only' => ['not_exit']]);
	}

	public function index()
	{
		return view('pages.list');
	}
	public function create()
	{
		$users = User::all();
		return view('pages/create', compact('users'));
	}
	public function store(Request $request)
	{
		$filename = '';
		if ($request->visitor_image) {
			$folderPath = public_path('/visitor_image/');

			$base64Image = explode(";base64,", $request->visitor_image);
			$explodeImage = explode("image/", $base64Image[0]);
			$imageType = $explodeImage[1];
			$image_base64 = base64_decode($base64Image[1]);
			$file = $folderPath . uniqid() . '.' . $imageType;

			file_put_contents($file, $image_base64);
		}
		$input['visitor_mobile'] = $request->visitor_mobile;
		$input['date'] = $request->date;
		$input['vname'] = $request->vname;
		$input['company'] = $request->company;
		$input['address'] = $request->address;
		$input['department'] = $request->department;
		// $input['employee'] = ($request->employee==''?0:$request->employee);
		$input['employee_email'] = ($request->employee == '' ? 0 : $request->employee);
		$input['purpose'] = $request->purpose;
		$input['company'] = $request->company;
		$input['nid'] = $request->nid;
		$input['card_no'] = $request->card_no;
		$input['in_time'] = $request->in_time;
		$input['out_time'] = $request->out_time;
		$input['comments'] = $request->comments;
		$input['company'] = $request->company;
		$input['company'] = $request->company;
		$input['visitor_image'] = $filename;
		$input['entrydate'] = date('Y-m-d');
		$input['created_by'] = Auth::user()->id;

		$visitor_id = DB::table('visitor')->insertGetId($input);

		return Redirect::back()->with('success', 'Data insert successfully');
		// dd($request);
	}


	public function get_visitor_list(Request $request)
	{
		$visitor = DB::table('visitor')
			->select('date', 'in_time', 'out_time')
			->where('visitor_mobile', $request->number)
			->get();
		foreach ($visitor as $key => $value) {
			echo '<tr>
			<td>' . $value->date . '</td>
			<td>' . $value->in_time . '</td>
			<td>' . $value->out_time . '</td>
			</tr>';
		}
	}
	public function get_visitor_data(Request $request)
	{
		$visitor = DB::table('visitor')
			->where('visitor_mobile', $request->number)
			->first();
		return json_encode($visitor);
	}

	public function serverSide(Request $request)
	{

		if ($request->ajax()) {
			$data = Visitor::latest()
				->select('visitor_mobile', 'date', 'vname', 'company', 'address', 'in_time', 'out_time')
				->get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					$actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
					return $actionBtn;
				})
				->rawColumns(['action'])
				->make(true);
		}
	}
	public function today_serverSide(Request $request)
	{
		$date = date('Y-m-d');

		if ($request->ajax()) {
			$data = Visitor::latest()
				->select('visitor_mobile', 'date', 'vname', 'company', 'address', 'in_time', 'out_time')
				->where('date', $date)
				->get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					$actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
					return $actionBtn;
				})
				->rawColumns(['action'])
				->make(true);
		}
	}
	public function get_exit_visitor_data()
	{
		$users = DB::table('visitor')
			->select('out_time')
			->where('is_exit', 1)->get();
		$i = 0;
		foreach ($users as $key => $value) {
			if (time() >= strtotime($value->out_time)) {
				$i++;;
			}
		}
		return $i;
	}
	public function not_exit_serverSide()
	{
		$users = DB::table('visitor')
			->select('id', 'visitor_mobile', 'date', 'vname', 'card_no', 'company', 'address', 'in_time', 'out_time', 'is_exit', 'out_time')
			->where('is_exit', 1)
			->orderBy('date', 'DESC')->get();
		return DataTables::of($users)
			->addColumn('action', function ($row) {
				return '<a href="' . url('/visitor_exit/' . $row->id . '/') . '">Exit <i class="fa fa-sign-out" aria-hidden="true"></i></a>';
			})
			->addColumn('active', function ($row) {
				if (time() >= strtotime($row->out_time)) {
					return 1;
				} else {
					return 0;
				}
			})

			->make(true);
	}
	public function visitor_exit($id)
	{
		$users = DB::table('visitor')
			->where('id', $id)
			->update([
				'is_exit' => 0,
				'exit_time' => date('h:i A')
			]);
		return  Redirect::back();
	}
	public function today_visitor_list()
	{
		return view('pages.today_visitor');
	}
	public function not_exit_list()
	{
		return view('pages.not_exit_list');
	}
}
