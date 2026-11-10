<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

   {{-- WYSIWIG: SUMMERNOTE --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <link href="/site_assets/wysiwig_summernote_0.9.0/summernote-lite.min.css" rel="stylesheet">
   <script src="/site_assets/wysiwig_summernote_0.9.0/summernote-lite.min.js"></script>

   <!-- 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.21.0/ckeditor.js"></script>
   -->
   {{-- WYSIWIG: SUMMERNOTE --}}

   <!-- Datatables -->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
   <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
   <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
   <!-- Datatables -->

   {{-- dropify --}}
   <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

   {{-- dropify --}}
   <style>
      /* Dropify wrapper styling */
      .dropify-wrapper {
         border: 2px solid #555 !important;
         border-radius: 16px;
         color: #ddd !important;
         background-color: #f9fafb;
         width: 100% !important;
         max-width: 100%;
      }

      /* Placeholder / overlay text */
      .dropify-message p {
         white-space: normal !important;
         font-size: 1.25rem;
         text-align: center;
         padding: 0 0.5rem;
         color: #bbb !important;
      }

      /* Uploaded image */
      .dropify-preview .dropify-render img {
         display: block !important;
         margin: auto !important;
         max-width: 80% !important;
         max-height: 80% !important;
         object-fit: contain;
         background-color: #444 !important;
      }

      /* Hover effect */
      .dropify-wrapper:hover {
         background-color: white !important;
         color: #bbb !important;
      }

      .dropify-wrapper:hover .dropify-message {
         color: #bbb !important;
      }

      /* Clear button */
      .dropify-clear {
         color: white !important;
      }
   </style>
   {{-- dropify --}}

   {{-- Dark Mode Trigger --}}
   <script>
      (function () {
         const savedTheme = localStorage.getItem('hs_theme');
         const html = document.documentElement;

         if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            html.classList.remove('light');
         } else {
            html.classList.add('light');
            html.classList.remove('dark');
         }

         html.classList.add('no-transitions');
      })();
   </script>

   <style>
      :root {
         --transition-theme:
            background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            border-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }

      html,
      body,
      div,
      section,
      header,
      nav,
      main,
      footer,
      article,
      aside,
      p,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      span,
      button,
      input,
      textarea,
      select,
      a {
         transition: var(--transition-theme);
      }

      .no-transitions *,
      .no-transitions *::before,
      .no-transitions *::after {
         transition: none !important;
      }

      @media (prefers-reduced-motion: reduce) {
         * {
            transition: none !important;
         }
      }
   </style>
   {{-- Dark Mode Trigger --}}

   
<script>
    // Reinitialize Preline after page transitions or dynamic content
    document.addEventListener('DOMContentLoaded', () => {
        // Small delay to ensure Preline is loaded
        setTimeout(() => {
            if (window.HSStaticMethods) {
                window.HSStaticMethods.autoInit(['overlay']);
            }
        }, 100);
    });
</script>

{{-- DataTable Dark Mode Style --}}
<style>
   .dark #dataTableDisplay_filter,
   .dark #dataTableDisplay_length,
   .dark #dataTableDisplay_info,
   .dark #dataTableDisplay_paginate,
   .dark #dataTableDisplay_previous,
   .dark #dataTableDisplay_next{
      color: white !important;
   }
</style>
{{-- DataTable Dark Mode Style --}}

   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>