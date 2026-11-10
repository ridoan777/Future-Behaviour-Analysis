<?php

namespace App\Helpers\Ui;

use App\Helpers\IconPack;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DatatableHelper
{
   // -----------------------------------------------
   public static function datatableAction($row, $toggle = true, $toggleRoute = null, $deleteRoute = null)
   {
      $toggleIcon = $row->status
         ? IconPack::toggleOn(['class' => 'iconPackItem w-8 h-8 text-green-500'])
         : IconPack::toggleOff(['class' => 'iconPackItem w-8 h-8 text-red-500']);

      $trashIcon = IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']);

      $toggleBtn = '';
      $deleteBtn = '';

      if ($toggle && $toggleRoute) {
         $toggleBtn = '
            <form action="' . route($toggleRoute, $row->id) . '" method="POST" class="toggleForm inline-flex items-center p-2">
                ' . csrf_field() . '
                <button type="submit">' . $toggleIcon . '</button>
            </form>';
      }

      if ($deleteRoute) {
         $deleteBtn = '
            <form action="' . route($deleteRoute, $row->id) . '" method="POST" class="deleteForm inline-flex items-center p-2">
                ' . csrf_field() . method_field('DELETE') . '
                <button type="submit" class="bg-red-500 p-2 rounded">' . $trashIcon . '</button>
            </form>';
      }

      return '
        <div class="flex justify-center items-center space-x-2">
            ' . $toggleBtn . '
            ' . $deleteBtn . '
        </div>';
   }

   // -----------------------------------------------

   public static function handleDatatableSuccess($draw, $recordsTotal, $recordsFiltered, $data)
   {
      return response()->json([
         'draw' => $draw,
         'recordsTotal' => $recordsTotal,
         'recordsFiltered' => $recordsFiltered,
         'data' => $data,
      ]);
   }
   // -----------------------------------------------

   public static function handleDatatableError($request, $error, $log = true, $logMssg = null)
   {
      if ($log) {
         Log::error($logMssg . ': ' . $error->getMessage());
      }
      return response()->json([
         'draw' => intval($request->input('draw')),
         'recordsTotal' => 0,
         'recordsFiltered' => 0,
         'data' => [],
         'error' => config('app.debug') ? $error->getMessage() : 'An error occurred.'
      ], 500);
   }
   // -----------------------------------------------

   public static function userBlock($user)
   {
      $avatar = $user?->avatar ?? null;
      $avatarHtml = $avatar
         ? '<img src="' . Storage::url($avatar) . '" class="w-10 h-10 rounded-full object-cover mx-auto" />'
         : '<img src="' . asset('site_assets/dummies/dummy_man.webp') . '" class="w-10 h-10 rounded-lg object-cover mx-auto opacity-70" />';

      $targetUserId = $user?->id ?? '—';
      $targetUserName = ($user?->first_name ?? '—') . " " . ($user?->last_name ?? null);
      $targetUserUid = $user?->user_uid ?? '—';
      $targetUserEmail = $user?->email ?? '—';

      return '
         <div class="flex items-center space-x-3 flex-nowrap">
            <div class="shrink-0">' . $avatarHtml . '</div>
            <div class="flex flex-col text-left">
               <span class="text-xs text-gray-400">DB ID: ' . $targetUserId . '</span>
               <span class="text-sm font-medium">' . $targetUserName . '</span>
               <span class="text-xs font-light text-gray-500 dark:text-gray-300"> UID: ' . $targetUserUid . '</span>
               <span class="text-xs text-gray-400 dark:text-gray-300">' . $targetUserEmail . '</span>
            </div>
         </div>
      ';
   }
   // -----------------------------------------------

   public static function detailBlock($content, $hasUid = true, $content_uid, $hasImage = true, $image)
   {
      if (is_array($content)) {
         $content = (object)$content;
      }
      $avatarHtml = $image
         ? '<img src="' . Storage::url($image) . '" class="w-10 h-10 rounded-lg   object-cover mx-auto" />'
         : '<img src="' . asset('site_assets/dummies/dummy_man.webp') . '" class="w-10 h-10 rounded-lg object-cover mx-auto opacity-70" />';

      $targetUserId = $content?->id ?? '—';
      $targetUserName = ($content?->title ?? '—');
      $targetUserUid = $content_uid ?? '—';

      $hideUid = $hasUid ? null : 'hidden';
      $hideImage = $hasImage ? null : 'hidden';

      return '
         <div class="flex items-center space-x-3 flex-nowrap">
            <div class="shrink-0 ' . $hideImage . '">' . $avatarHtml . '</div>
            <div class="flex flex-col text-left">
               <span class="text-xs text-gray-400">DB ID: ' . $targetUserId . '</span>
               <span class="text-sm font-medium">' . $targetUserName . '</span>
               <span class="text-xs font-light text-gray-500 dark:text-gray-300 ' . $hideUid . '"> UID: ' . $targetUserUid . '</span>
            </div>
         </div>
      ';
   }
   // -----------------------------------------------

   public static function phaseColor($phase)
   {
      $phaseColor = [
         'pending' => 'bg-orange-400 opacity-75',
         'payment_pending' => 'bg-orange-400 opacity-75',
         // -------------------------
         'paid' => 'bg-green-400 opacity-75',
         'sub_renewed' => 'bg-violet-400 opacity-75',
         // -------------------------
         'cancel_scheduled' => 'bg-rose-400 opacity-75',
         'cancelled' => 'bg-fuchsia-400 opacity-75',
         'payment_failed' => 'bg-red-400 opacity-75',
      ];

      $matchPhase = strtolower($phase);
      $color = $phaseColor[$matchPhase] ?? 'bg-gray-400';

      return '<span class="px-2 py-1 text-xs font-medium rounded ' . $color . '  text-white">' . ucfirst($matchPhase) . '</span>';
   }
}
// -----------------------------------------------

/*
USE CASE-1: success + error
   try {
      return DatatableHelper::handleDatatableSuccess($draw, $recordsTotal, $recordsFiltered, $data);
   } catch (Throwable $e) {
      return DatatableHelper::handleDatatableError($request, $e, true, "Workmen jobs datatable error");
   }

USE CASE-2: action
   $row->actions = DatatableHelper::datatableAction($row, true, 'backend_issue_toggle', 'backend_issue_delete');

   // here, true = there'll be a toggle button

USE CASE-3: user
   // -------- User --------
   $row->merchant_info = DatatableHelper::userBlock($row->productRelatingBackTo_Merchant);
*/