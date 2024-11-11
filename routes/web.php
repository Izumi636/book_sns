<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\GroupCommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\ReviewsController;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'logout'])->name('logout');

Auth::routes();
Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/all-reviews', [HomeController::class, 'allReviews'])->name('allReviews');
    Route::get('/books/search', [HomeController::class, 'search'])->name('search');
    Route::get('/books/suggestion', [HomeController::class, 'suggestion'])->name('suggestion');


    Route::post('/like/{review_id}/store', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{review_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');
    
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
    Route::patch('/notification/{id}/setRead', [NotificationController::class, 'setRead'])->name('notification.setRead');
    Route::patch('/notification/{id}/setUnread', [NotificationController::class, 'setUnread'])->name('notification.setUnread');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{id}/add', [MessageController::class, 'add'])->name('messages.add');
    Route::post('/messages/{id}/store', [MessageController::class, 'store'])->name('messages.store');
    Route::patch('/messages/{id}/setRead', [MessageController::class, 'setRead'])->name('messages.setRead');
    Route::patch('/messages/{id}/setUnread', [MessageController::class, 'setUnread'])->name('messages.setUnread');
    Route::get('/messages/outbox', [MessageController::class, 'outbox'])->name('messages.outbox');
    Route::get('/messages/trashBox', [MessageController::class, 'trashBox'])->name('messages.trashBox');
    Route::delete('/messages/{id}/delete', [MessageController::class, 'delete'])->name('messages.delete');
    Route::patch('/messages/{id}/restore', [MessageController::class, 'restore'])->name('messages.restore');


    Route::group(['prefix' => 'groups', 'as' => 'groups.'], function(){

        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/create', [GroupController::class, 'create'])->name('create');
        Route::post('/store', [GroupController::class, 'store'])->name('store');
        Route::get('/{id}/show', [GroupController::class, 'show'])->name('show');
        Route::patch('/{id}/edit', [GroupController::class, 'edit'])->name('edit');
        Route::delete('/{id}/delete', [GroupController::class, 'delete'])->name('delete');
        Route::post('/{group}/comment/store', [GroupCommentController::class, 'store'])->name('comment.store');
        Route::delete('/{group}/comment/destroy', [GroupCommentController::class, 'destroy'])->name('comment.destroy');

    });

    Route::post('/{group_id}/join', [GroupUserController::class, 'join'])->name('join');
    Route::delete('/{group_id}/leave', [GroupUserController::class, 'leave'])->name('leave');

    Route::post('/favorite/{book_id}/store', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{book_id}/destroy', [FavoriteController::class, 'destroy'])->name('favorite.destroy');


    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');


    Route::post('/comment/{review_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');


Route::group(['prefix' => 'books', 'as' =>'books.'], function(){
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/create', [BookController::class, 'create'])->name('create');
    Route::post('/store', [BookController::class, 'store'])->name('store');
    Route::get('/{id}/show', [BookController::class, 'show'])->name('show');
    Route::get('/{id}/delete', [BookController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [BookController::class, 'update'])->name('update');
    Route::get('/{id}/calculation', [BookController::class, 'calculation'])->name('calculation');


});

Route::group(['prefix' => 'author', 'as' => 'authors.'], function(){
    Route::get('/add', [AuthorController::class, 'add'])->name('add');
    Route::post('/store', [AuthorController::class, 'store'])->name('store');
    Route::delete('/{id}/destroy', [AuthorController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/edit', [AuthorController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [AuthorController::class, 'update'])->name('update');


});

Route::group(['prefix' => 'reviews', 'as' =>'reviews.'], function(){
    Route::get('/add/{id}', [ReviewController::class, 'add'])->name('add');
    Route::post('/store/{id}', [ReviewController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ReviewController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [ReviewController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [ReviewController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/show', [ReviewController::class, 'show'])->name('show');


});

    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profiles.show');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');
    Route::get('/profile/{id}/favorite', [ProfileController::class, 'favorite'])->name('profile.favorite');
    Route::get('/profile/{id}/added', [ProfileController::class, 'added'])->name('profile.added');


Route::group(['prefix'=>'admin', 'as'=>'admin.'], function(){
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');
    Route::patch('/users/{id}/setAdminRole', [UsersController::class, 'setAdminRole'])->name('users.setAdminRole');
    Route::patch('/users/{id}/setUserRole', [UsersController::class, 'setUserRole'])->name('users.setUserRole');

    Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews');
    Route::delete('/review/{id}/hide', [ReviewsController::class, 'hide'])->name('reviews.hide');
    Route::patch('/review/{id}/unhide', [ReviewsController::class, 'unhide'])->name('reviews.unhide');

    Route::get('/books', [BooksController::class, 'index'])->name('books');
    Route::delete('/book/{id}/hide', [BooksController::class, 'hide'])->name('books.hide');
    Route::patch('/book/{id}/unhide', [BooksController::class, 'unhide'])->name('books.unhide');

});
});