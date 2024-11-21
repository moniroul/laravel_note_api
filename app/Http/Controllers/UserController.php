
<?php

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function storeBasicInfo(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string',
            'postcode' => 'required|string',
            'number' => 'required|string',
        ]);

        // $user = Auth::user();
        Auth::guard('api')->user()->basicInfo()->create($validated);

        return response()->json(['message' => 'Basic info saved successfully.']);
    }
}
