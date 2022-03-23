<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PostRead;
use Auth;
use App\Models\Post;

class PostReadActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $result =  $next($request);
        
        $post = $request->route('post');
        if (!is_string($post)) {
            if ($post->published) {
                if (Auth::check()) {
        
                    if ($post->user_id !== Auth::id()) {
                        
                        $readPost = PostRead::where('user_id', Auth::id())
                                            ->where('post_id', $post->id)
                                            //->orWhere('ip_address', $request->ip())
                                            //->orWhere('user_agent', $request->server('HTTP_USER_AGENT'))
                                            ->first();

                        if (!empty($readPost)) {
                            $readPost->update([
                                'user_id' => Auth::id(),
                                'read_type' => 'auth',
                                'ip_address' => $request->ip(),
                                'user_agent' => $request->server('HTTP_USER_AGENT'),
                                'updated_at' => now()
                            ]);
                        } else {
                            PostRead::create([
                                'post_id' => $post->id,
                                'user_id' => Auth::id(),
                                'read_type' => 'auth',
                                'ip_address' => $request->ip(),
                                'user_agent' => $request->server('HTTP_USER_AGENT')
                            ]);
                        }
                    }
                } else {
                    $readPost = PostRead::where('post_id', $post->id)
                                        //->orWhere('ip_address', $request->ip())
                                        //->orWhere('user_agent', $request->server('HTTP_USER_AGENT'))
                                       ->where(function ($query) use ($request) {
                                            $query->where('ip_address', $request->ip())
                                                  ->orWhere('user_agent', $request->server('HTTP_USER_AGENT'));
                                        })
                                        ->first();
                    
                    if (!empty($readPost)) {
                        $readPost->update([
                            'read_type' => 'guest',
                            'ip_address' => $request->ip(),
                            'user_agent' => $request->server('HTTP_USER_AGENT'),
                            'updated_at' => now()
                        ]);
                    } else {
                        PostRead::create([
                            'post_id' => $post->id,
                            'read_type' => 'guest',
                            'ip_address' => $request->ip(),
                            'user_agent' => $request->server('HTTP_USER_AGENT')
                        ]);
                    }
                }
            }
        }
        
        return $result;
    }
}
