<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\RejectLeave;
use App\Mail\LeaveGranted;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeaveController extends Controller
{
    function LeavePage(Request $request) {
        return view('pages.dashboard.leave-page');
    }

    function CreateLeaveRequest(Request $request) {

        try {
            $user_id=$request->header('id');
            return LeaveRequest::create([
                'leave_category_id' => $request->input('catId'),
                'start_date' => $request->input('begDate'),
                'end_date' => $request->input('endDate'),
                'reason' => $request->input('reason'),
                'user_id' => $user_id
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    function LeaveList(Request $request) {
        return LeaveRequest::with(['user','LeaveCategory'])->where('status', 'pending')->get();
    }

    function TotalLeave(Request $request) {
        $total =  LeaveRequest::get()->count();
        $approved = LeaveRequest::where('status', 'approved')->count();
        $rejected =  LeaveRequest::where('status', 'rejected')->count();
        $pending =  LeaveRequest::where('status', 'pending')->count();
        return response()->json([
            'total' => $total,
            'approved' => $approved,
            'rejected' => $rejected,
            'pending' => $pending,
        ]);
    }


    function ApproveLeave(Request $request) {
        $leave_id=$request->input('id');
        try {
           LeaveRequest::where('id', $leave_id)->update([
                'status' => 'approved'
            ]);
            $leaveRequest = LeaveRequest::find($leave_id);
            $leaveBalance = LeaveBalance::where('user_id', $leaveRequest->user_id)->first();
            $user = User::where('id', $leaveRequest->user_id)->first();
            $diff = Carbon::parse($leaveRequest->end_date)->diffInDays(Carbon::parse($leaveRequest->start_date))+1;
            
            if($leaveBalance->balance >= $diff) {
                $balance = $leaveBalance->balance - $diff;
                LeaveBalance::where('user_id', $leaveRequest->user_id)->update([
                    'balance' => $balance
                ]);
                Mail::to($user->email)->send(new LeaveGranted($balance));
            }
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed'
            ]);
        }
    }

    function RejectLeave(Request $request) {
        $leave_id=$request->input('id');
        $leaveRequest = LeaveRequest::find($leave_id);
        $user = User::where('id', $leaveRequest->user_id)->first();
        LeaveRequest::where('id', $leave_id)->update([
            'status' => 'rejected'
        ]);
         Mail::to($user->email)->send(new RejectLeave());
    }
}
