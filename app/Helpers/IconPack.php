<?php

namespace App\Helpers;
/*
{!! \App\Helpers\IconPack::home(['class' => 'iconPackItem w-5 h-5 text-gray-500']) !!}
/*
ambulance		 |						|
book            | bracketLeft    | bracketRight   | bycycle			 | bike				| bus
calender        | calenderLine   | chevronDown	  | carAccident	 | ..					| ..			
chevronLeft     | chevronUp      | clock          | compare        | copy           | cross
cubic		       | car		      | chargingStation| crash	       | ..	            | ..

darkMode        | division       | document       | documentLines  | dollar         | dollarSack
dollarSackLine  | dotsVertical   | downloadBar    | downloadCloud  | downloadFile   | edit
envelope        | eye            | eyeSlash       | file           | form           | ...
gear				 |	gearLine       | globe          | ..				 | ..					| ..
home            | homeLines      | hourglassHalf  | helicopter		 | hammer			| ..

key				 |
language        | lightMode      | list           | listLined      | location       | lock
layer	    		 | ...		      | ..		        | ..	          | ..	            | ..
map             | minus          | mobile         | monitor        | ..					| ..
pickupVan       | pickupVanLined | pickupTruck	  | paste          | pdf				| petrolPump
phone           | phoneSquare    | plus           | ..	          | .. 	         | .. 

repair          | ribbon 			| ..	           | ..	          | .. 	         | .. 
search          | singleTick     | squareTick 	  | squarePoll		 | ...	  		   | telegramArrow 		   
trash           | taxy	         | train      	  | toolbox    	 | toggleOn     	| toggleOff
...           	 | unlock         | uploadBar      | uploadCloud    | uploadFile     | userCancel
userFocus       | userGear       | userLock       | userSecret     | userSingle     | userSingleLine
userTripple     | userTrippleLine| bell           | bellSlash      | 

*/

class IconPack
{
	public $iconList = [];
	// ----------------HOME----------------------
	public static function home(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" $attrString fill="currentColor">
					<path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
				</svg>
				SVG;
	}
	// ---------
	public static function homeLines(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M304 70.1C313.1 61.9 326.9 61.9 336 70.1L568 278.1C577.9 286.9 578.7 302.1 569.8 312C560.9 321.9 545.8 322.7 535.9 313.8L527.9 306.6L527.9 511.9C527.9 547.2 499.2 575.9 463.9 575.9L175.9 575.9C140.6 575.9 111.9 547.2 111.9 511.9L111.9 306.6L103.9 313.8C94 322.6 78.9 321.8 70 312C61.1 302.2 62 287 71.8 278.1L304 70.1zM320 120.2L160 263.7L160 512C160 520.8 167.2 528 176 528L224 528L224 424C224 384.2 256.2 352 296 352L344 352C383.8 352 416 384.2 416 424L416 528L464 528C472.8 528 480 520.8 480 512L480 263.7L320 120.3zM272 528L368 528L368 424C368 410.7 357.3 400 344 400L296 400C282.7 400 272 410.7 272 424L272 528z"/></svg>
				SVG;
	}
	// ---------
	// -----------------COPY---------------------
	public static function copy(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor">
					<path d="M208 0L332.1 0c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9L448 336c0 26.5-21.5 48-48 48l-192 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48zM48 128l80 0 0 64-64 0 0 256 192 0 0-32 64 0 0 48c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 176c0-26.5 21.5-48 48-48z"/>
				</svg>
				SVG;
	}
	// -----------------USERS---------------------
	public static function userSingle(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
			SVG;
	}
	// ----------
	public static function userSingleLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M240 192C240 147.8 275.8 112 320 112C364.2 112 400 147.8 400 192C400 236.2 364.2 272 320 272C275.8 272 240 236.2 240 192zM448 192C448 121.3 390.7 64 320 64C249.3 64 192 121.3 192 192C192 262.7 249.3 320 320 320C390.7 320 448 262.7 448 192zM144 544C144 473.3 201.3 416 272 416L368 416C438.7 416 496 473.3 496 544L496 552C496 565.3 506.7 576 520 576C533.3 576 544 565.3 544 552L544 544C544 446.8 465.2 368 368 368L272 368C174.8 368 96 446.8 96 544L96 552C96 565.3 106.7 576 120 576C133.3 576 144 565.3 144 552L144 544z"/></svg>
			SVG;
	}
	// ----------
	public static function userTripple(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="currentColor"><path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z"/></svg>
			SVG;
	}
	// ----------
	public static function userTrippleLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="none" stroke="currentColor" stroke-width="40" stroke-linecap="round" stroke-linejoin="round"><circle cx="144" cy="80" r="80"/><circle cx="512" cy="80" r="80"/><path d="M0 298.7c0-59.0 47.8-106.7 106.7-106.7h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96l-243.3 0c-11.7 0-21.3-9.6-21.3-21.3z"/><path d="M405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7c58.9 0 106.7 47.8 106.7 106.7c0 11.8-9.6 21.3-21.3 21.3H405.3z"/><circle cx="320" cy="224" r="96"/><path d="M128 485.3c0-73.6 59.7-133.3 133.3-133.3h117.3c64.0 0 123.7 59.7 123.7 133.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"/>
				</svg>
				SVG;
	}

	// ----------
	public static function userSecret(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M224 16c-6.7 0-10.8-2.8-15.5-6.1C201.9 5.4 194 0 176 0c-30.5 0-52 43.7-66 89.4C62.7 98.1 32 112.2 32 128c0 14.3 25 27.1 64.6 35.9c-.4 4-.6 8-.6 12.1c0 17 3.3 33.2 9.3 48l-59.9 0C38 224 32 230 32 237.4c0 1.7 .3 3.4 1 5l38.8 96.9C28.2 371.8 0 423.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7c0-58.5-28.2-110.4-71.7-143L415 242.4c.6-1.6 1-3.3 1-5c0-7.4-6-13.4-13.4-13.4l-59.9 0c6-14.8 9.3-31 9.3-48c0-4.1-.2-8.1-.6-12.1C391 155.1 416 142.3 416 128c0-15.8-30.7-29.9-78-38.6C324 43.7 302.5 0 272 0c-18 0-25.9 5.4-32.5 9.9c-4.8 3.3-8.8 6.1-15.5 6.1zm56 208l-12.4 0c-16.5 0-31.1-10.6-36.3-26.2c-2.3-7-12.2-7-14.5 0c-5.2 15.6-19.9 26.2-36.3 26.2L168 224c-22.1 0-40-17.9-40-40l0-14.4c28.2 4.1 61 6.4 96 6.4s67.8-2.3 96-6.4l0 14.4c0 22.1-17.9 40-40 40zm-88 96l16 32L176 480 128 288l64 32zm128-32L272 480 240 352l16-32 64-32z"/></svg>
			SVG;
	}
	// ----------
	public static function userGear(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="currentColor"><path d="M144 160A80 80 0 1 0 144 0a80 80 0 1 0 0 160zm368 0A80 80 0 1 0 512 0a80 80 0 1 0 0 160zM0 298.7C0 310.4 9.6 320 21.3 320l213.3 0c.2 0 .4 0 .7 0c-26.6-23.5-43.3-57.8-43.3-96c0-7.6 .7-15 1.9-22.3c-13.6-6.3-28.7-9.7-44.6-9.7l-42.7 0C47.8 192 0 239.8 0 298.7zM320 320c24 0 45.9-8.8 62.7-23.3c2.5-3.7 5.2-7.3 8-10.7c2.7-3.3 5.7-6.1 9-8.3C410 262.3 416 243.9 416 224c0-53-43-96-96-96s-96 43-96 96s43 96 96 96zm65.4 60.2c-10.3-5.9-18.1-16.2-20.8-28.2l-103.2 0C187.7 352 128 411.7 128 485.3c0 14.7 11.9 26.7 26.7 26.7l300.6 0c-2.1-5.2-3.2-10.9-3.2-16.4l0-3c-1.3-.7-2.7-1.5-4-2.3l-2.6 1.5c-16.8 9.7-40.5 8-54.7-9.7c-4.5-5.6-8.6-11.5-12.4-17.6l-.1-.2-.1-.2-2.4-4.1-.1-.2-.1-.2c-3.4-6.2-6.4-12.6-9-19.3c-8.2-21.2 2.2-42.6 19-52.3l2.7-1.5c0-.8 0-1.5 0-2.3s0-1.5 0-2.3l-2.7-1.5zM533.3 192l-42.7 0c-15.9 0-31 3.5-44.6 9.7c1.3 7.2 1.9 14.7 1.9 22.3c0 17.4-3.5 33.9-9.7 49c2.5 .9 4.9 2 7.1 3.3l2.6 1.5c1.3-.8 2.6-1.6 4-2.3l0-3c0-19.4 13.3-39.1 35.8-42.6c7.9-1.2 16-1.9 24.2-1.9s16.3 .6 24.2 1.9c22.5 3.5 35.8 23.2 35.8 42.6l0 3c1.3 .7 2.7 1.5 4 2.3l2.6-1.5c16.8-9.7 40.5-8 54.7 9.7c2.3 2.8 4.5 5.8 6.6 8.7c-2.1-57.1-49-102.7-106.6-102.7zm91.3 163.9c6.3-3.6 9.5-11.1 6.8-18c-2.1-5.5-4.6-10.8-7.4-15.9l-2.3-4c-3.1-5.1-6.5-9.9-10.2-14.5c-4.6-5.7-12.7-6.7-19-3l-2.9 1.7c-9.2 5.3-20.4 4-29.6-1.3s-16.1-14.5-16.1-25.1l0-3.4c0-7.3-4.9-13.8-12.1-14.9c-6.5-1-13.1-1.5-19.9-1.5s-13.4 .5-19.9 1.5c-7.2 1.1-12.1 7.6-12.1 14.9l0 3.4c0 10.6-6.9 19.8-16.1 25.1s-20.4 6.6-29.6 1.3l-2.9-1.7c-6.3-3.6-14.4-2.6-19 3c-3.7 4.6-7.1 9.5-10.2 14.6l-2.3 3.9c-2.8 5.1-5.3 10.4-7.4 15.9c-2.6 6.8 .5 14.3 6.8 17.9l2.9 1.7c9.2 5.3 13.7 15.8 13.7 26.4s-4.5 21.1-13.7 26.4l-3 1.7c-6.3 3.6-9.5 11.1-6.8 17.9c2.1 5.5 4.6 10.7 7.4 15.8l2.4 4.1c3 5.1 6.4 9.9 10.1 14.5c4.6 5.7 12.7 6.7 19 3l2.9-1.7c9.2-5.3 20.4-4 29.6 1.3s16.1 14.5 16.1 25.1l0 3.4c0 7.3 4.9 13.8 12.1 14.9c6.5 1 13.1 1.5 19.9 1.5s13.4-.5 19.9-1.5c7.2-1.1 12.1-7.6 12.1-14.9l0-3.4c0-10.6 6.9-19.8 16.1-25.1s20.4-6.6 29.6-1.3l2.9 1.7c6.3 3.6 14.4 2.6 19-3c3.7-4.6 7.1-9.4 10.1-14.5l2.4-4.2c2.8-5.1 5.3-10.3 7.4-15.8c2.6-6.8-.5-14.3-6.8-17.9l-3-1.7c-9.2-5.3-13.7-15.8-13.7-26.4s4.5-21.1 13.7-26.4l3-1.7zM472 384a40 40 0 1 1 80 0 40 40 0 1 1 -80 0z"/></svg>
			SVG;
	}
	// ----------
	public static function userFocus(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M96 64C60.7 64 32 92.7 32 128L32 200C32 213.3 42.7 224 56 224C69.3 224 80 213.3 80 200L80 128C80 119.2 87.2 112 96 112L168 112C181.3 112 192 101.3 192 88C192 74.7 181.3 64 168 64L96 64zM472 64C458.7 64 448 74.7 448 88C448 101.3 458.7 112 472 112L544 112C552.8 112 560 119.2 560 128L560 200C560 213.3 570.7 224 584 224C597.3 224 608 213.3 608 200L608 128C608 92.7 579.3 64 544 64L472 64zM80 440C80 426.7 69.3 416 56 416C42.7 416 32 426.7 32 440L32 512C32 547.3 60.7 576 96 576L168 576C181.3 576 192 565.3 192 552C192 538.7 181.3 528 168 528L96 528C87.2 528 80 520.8 80 512L80 440zM608 440C608 426.7 597.3 416 584 416C570.7 416 560 426.7 560 440L560 512C560 520.8 552.8 528 544 528L472 528C458.7 528 448 538.7 448 552C448 565.3 458.7 576 472 576L544 576C579.3 576 608 547.3 608 512L608 440zM320 280C350.9 280 376 254.9 376 224C376 193.1 350.9 168 320 168C289.1 168 264 193.1 264 224C264 254.9 289.1 280 320 280zM320 320C267 320 224 363 224 416L224 440C224 453.3 234.7 464 248 464L392 464C405.3 464 416 453.3 416 440L416 416C416 363 373 320 320 320zM512 256C512 229.5 490.5 208 464 208C437.5 208 416 229.5 416 256C416 282.5 437.5 304 464 304C490.5 304 512 282.5 512 256zM200 336.3C150.7 340.4 112 381.6 112 432L112 442.7C112 454.5 121.6 464 133.3 464L180.1 464C177.4 456.5 176 448.4 176 440L176 416C176 386.5 184.8 359.1 200 336.3zM459.9 464L506.7 464C518.5 464 528 454.4 528 442.7L528 432C528 381.7 489.3 340.4 440 336.3C455.2 359.1 464 386.5 464 416L464 440C464 448.4 462.6 456.5 459.9 464zM224 256C224 229.5 202.5 208 176 208C149.5 208 128 229.5 128 256C128 282.5 149.5 304 176 304C202.5 304 224 282.5 224 256z"/></svg>
			SVG;
	}
	// ----------
	public static function userCancel(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M73 39.1C63.6 29.7 48.4 29.7 39.1 39.1C29.8 48.5 29.7 63.7 39 73.1L567 601.1C576.4 610.5 591.6 610.5 600.9 601.1C610.2 591.7 610.3 576.5 600.9 567.2L321.8 288C378.4 287 424 240.8 424 184C424 126.6 377.4 80 320 80C263.2 80 217 125.6 216 182.2L73 39.1zM512 352C494.8 352 478.3 355.4 463.3 361.6L633.3 531.6C637.5 526.2 640 519.4 640 512L640 480C640 409.3 582.7 352 512 352zM59.9 161.7C38.4 174.2 24 197.4 24 224C24 263.8 56.2 296 96 296C122.6 296 145.8 281.6 158.3 260.1L59.9 161.7zM250.2 352C196.8 377.9 160 432.7 160 496L160 512C160 529.7 174.3 544 192 544L442.2 544L250.2 352zM128 352C57.3 352 0 409.3 0 480L0 512C0 529.7 14.3 544 32 544L118.7 544C114.4 534.2 112 523.4 112 512L112 496C112 442.8 132 394.2 164.9 357.4C153.2 353.9 140.8 352 128 352zM616 224C616 184.2 583.8 152 544 152C504.2 152 472 184.2 472 224C472 263.8 504.2 296 544 296C583.8 296 616 263.8 616 224z"/></svg>
			SVG;
	}

	// -----------------PASTE---------------------
	public static function paste(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor">
					<path d="M192 0c-41.8 0-77.4 26.7-90.5 64L64 64C28.7 64 0 92.7 0 128L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64l-37.5 0C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM112 192l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
					</svg>
				SVG;
	}

	// ----------------ENVELOPE----------------------
	public static function envelope(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
				SVG;
	}

	// ----------------GEAR----------------------
	public static function gear(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
				SVG;
	}

	// ---------------
	public static function gearLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" 
             stroke-linecap="round" stroke-linejoin="round" $attrString fill="currentColor"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
        SVG;
	}


	// ----------------SEARCH----------------------
	public static function search(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
				SVG;
	}

	// ----------------TRASH----------------------
	public static function trash(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
				SVG;
	}

	// ----------------EDIT----------------------
	public static function edit(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/></svg>
				SVG;
	}

	// ----------------CHECK/TICK----------------------
	public static function singleTick(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
				SVG;
	}
	// ----------------
	public static function squareTick(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
				SVG;
	}
	// ----------------
	public static function circleTick(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
				SVG;
	}

	// ----------------TIME----------------------
	public static function hourglassHalf(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor"><path d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64l0 11c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437l0 11c-17.7 0-32 14.3-32 32s14.3 32 32 32l32 0 256 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-11c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1l0-11c17.7 0 32-14.3 32-32s-14.3-32-32-32L320 0 64 0 32 0zM96 75l0-11 192 0 0 11c0 19-5.6 37.4-16 53L112 128c-10.3-15.6-16-34-16-53zm16 309c3.5-5.3 7.6-10.3 12.1-14.9L192 301.3l67.9 67.9c4.6 4.6 8.6 9.6 12.1 14.9L112 384z"/></svg>
				SVG;
	}
	// ----------------
	public static function clock(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
				SVG;
	}

	// ----------------MATH----------------------
	public static function cross(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
				SVG;
	}
	// ----------------
	public static function plus(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
				SVG;
	}
	// ----------------
	public static function minus(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
				SVG;
	}
	// ----------------
	public static function division(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M272 96a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 320a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM400 288c17.7 0 32-14.3 32-32s-14.3-32-32-32L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l352 0z"/></svg>
				SVG;
	}

	// ----------------COMPARE----------------------
	public static function compare(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M320 488c0 9.5-5.6 18.1-14.2 21.9s-18.8 2.3-25.8-4.1l-80-72c-5.1-4.6-7.9-11-7.9-17.8s2.9-13.3 7.9-17.8l80-72c7-6.3 17.2-7.9 25.8-4.1s14.2 12.4 14.2 21.9l0 40 16 0c35.3 0 64-28.7 64-64l0-166.7C371.7 141 352 112.8 352 80c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3L464 320c0 70.7-57.3 128-128 128l-16 0 0 40zM456 80a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM192 24c0-9.5 5.6-18.1 14.2-21.9s18.8-2.3 25.8 4.1l80 72c5.1 4.6 7.9 11 7.9 17.8s-2.9 13.3-7.9 17.8l-80 72c-7 6.3-17.2 7.9-25.8 4.1s-14.2-12.4-14.2-21.9l0-40-16 0c-35.3 0-64 28.7-64 64l0 166.7c28.3 12.3 48 40.5 48 73.3c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-32.8 19.7-61 48-73.3L48 192c0-70.7 57.3-128 128-128l16 0 0-40zM56 432a24 24 0 1 0 48 0 24 24 0 1 0 -48 0z"/></svg>
				SVG;
	}

	// ----------------LOCK----------------------
	public static function lock(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z"/></svg>
				SVG;
	}
	// ----------------
	public static function key(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M400 416C497.2 416 576 337.2 576 240C576 142.8 497.2 64 400 64C302.8 64 224 142.8 224 240C224 258.7 226.9 276.8 232.3 293.7L71 455C66.5 459.5 64 465.6 64 472L64 552C64 565.3 74.7 576 88 576L168 576C181.3 576 192 565.3 192 552L192 512L232 512C245.3 512 256 501.3 256 488L256 448L296 448C302.4 448 308.5 445.5 313 441L346.3 407.7C363.2 413.1 381.3 416 400 416zM440 160C462.1 160 480 177.9 480 200C480 222.1 462.1 240 440 240C417.9 240 400 222.1 400 200C400 177.9 417.9 160 440 160z"/></svg>
				SVG;
	}
	// ----------------
	public static function unlock(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" $attrString fill="currentColor"><path d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80l0 48c0 17.7 14.3 32 32 32s32-14.3 32-32l0-48C576 64.5 511.5 0 432 0S288 64.5 288 144l0 48L64 192c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-192c0-35.3-28.7-64-64-64l-32 0 0-48z"/></svg>
				SVG;
	}
	// ----------------
	public static function userLock(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="currentColor"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l362.8 0c-5.4-9.4-8.6-20.3-8.6-32l0-128c0-2.1 .1-4.2 .3-6.3c-31-26-71-41.7-114.6-41.7l-91.4 0zM528 240c17.7 0 32 14.3 32 32l0 48-64 0 0-48c0-17.7 14.3-32 32-32zm-80 32l0 48c-17.7 0-32 14.3-32 32l0 128c0 17.7 14.3 32 32 32l160 0c17.7 0 32-14.3 32-32l0-128c0-17.7-14.3-32-32-32l0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80z"/></svg>
				SVG;
	}


	// ----------------MAP/LOCATION----------------------
	public static function location(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
				SVG;
	}
	// ----------------
	public static function map(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" $attrString fill="currentColor"><path d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152l0 270.8c0 9.8-6 18.6-15.1 22.3L416 503l0-302.6zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6l0 251.4L32.9 502.7C17.1 509 0 497.4 0 480.4L0 209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77l0 249.3L192 449.4 192 255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
				SVG;
	}
	// ----------------
	public static function globe(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z"/></svg>
				SVG;
	}
	// ----------------
	public static function streetView(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M320 64A64 64 0 1 0 192 64a64 64 0 1 0 128 0zm-96 96c-35.3 0-64 28.7-64 64l0 48c0 17.7 14.3 32 32 32l1.8 0 11.1 99.5c1.8 16.2 15.5 28.5 31.8 28.5l38.7 0c16.3 0 30-12.3 31.8-28.5L318.2 304l1.8 0c17.7 0 32-14.3 32-32l0-48c0-35.3-28.7-64-64-64l-64 0zM132.3 394.2c13-2.4 21.7-14.9 19.3-27.9s-14.9-21.7-27.9-19.3c-32.4 5.9-60.9 14.2-82 24.8c-10.5 5.3-20.3 11.7-27.8 19.6C6.4 399.5 0 410.5 0 424c0 21.4 15.5 36.1 29.1 45c14.7 9.6 34.3 17.3 56.4 23.4C130.2 504.7 190.4 512 256 512s125.8-7.3 170.4-19.6c22.1-6.1 41.8-13.8 56.4-23.4c13.7-8.9 29.1-23.6 29.1-45c0-13.5-6.4-24.5-14-32.6c-7.5-7.9-17.3-14.3-27.8-19.6c-21-10.6-49.5-18.9-82-24.8c-13-2.4-25.5 6.3-27.9 19.3s6.3 25.5 19.3 27.9c30.2 5.5 53.7 12.8 69 20.5c3.2 1.6 5.8 3.1 7.9 4.5c3.6 2.4 3.6 7.2 0 9.6c-8.8 5.7-23.1 11.8-43 17.3C374.3 457 318.5 464 256 464s-118.3-7-157.7-17.9c-19.9-5.5-34.2-11.6-43-17.3c-3.6-2.4-3.6-7.2 0-9.6c2.1-1.4 4.8-2.9 7.9-4.5c15.3-7.7 38.8-14.9 69-20.5z"/></svg>
				SVG;
	}

	// ----------------EYE----------------------
	public static function eye(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" $attrString fill="currentColor"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
				SVG;
	}

	// ----------------
	public static function eyeSlash(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="currentColor"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>
				SVG;
	}

	// ----------------DOWNLOAD----------------------
	public static function downloadBar(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
				SVG;
	}
	// ----------------
	public static function downloadFile(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor"><path d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM216 232l0 102.1 31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31L168 232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
				SVG;
	}
	// ----------------
	public static function downloadCloud(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="currentColor"><path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-167l80 80c9.4 9.4 24.6 9.4 33.9 0l80-80c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-39 39L344 184c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 134.1-39-39c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9z"/></svg>
				SVG;
	}
	// ----------------
	public static function downloadCircle(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM244.7 395.3l-112-112c-4.6-4.6-5.9-11.5-3.5-17.4s8.3-9.9 14.8-9.9l64 0 0-96c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 96 64 0c6.5 0 12.3 3.9 14.8 9.9s1.1 12.9-3.5 17.4l-112 112c-6.2 6.2-16.4 6.2-22.6 0z"/></svg>
				SVG;
	}

	// ----------------UPLOAD----------------------
	public static function uploadBar(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M288 109.3L288 352c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-242.7-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352l128 0c0 35.3 28.7 64 64 64s64-28.7 64-64l128 0c35.3 0 64 28.7 64 64l0 32c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64l0-32c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
				SVG;
	}

	// ----------------
	public static function uploadCloud(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="currentColor"><path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"/></svg>
				SVG;
	}

	// ----------------
	public static function uploadFile(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor"><path d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-102.1-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31L216 408z"/></svg>
				SVG;
	}

	// ----------------PHONES----------------------
	public static function phone(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
				SVG;
	}

	// ----------------
	public static function phoneSquare(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm90.7 96.7c9.7-2.6 19.9 2.3 23.7 11.6l20 48c3.4 8.2 1 17.6-5.8 23.2L168 231.7c16.6 35.2 45.1 63.7 80.3 80.3l20.2-24.7c5.6-6.8 15-9.2 23.2-5.8l48 20c9.3 3.9 14.2 14 11.6 23.7l-12 44C336.9 378 329 384 320 384C196.3 384 96 283.7 96 160c0-9 6-16.9 14.7-19.3l44-12z"/></svg>
				SVG;
	}

	// ----------------
	public static function mobile(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor"><path d="M16 64C16 28.7 44.7 0 80 0L304 0c35.3 0 64 28.7 64 64l0 384c0 35.3-28.7 64-64 64L80 512c-35.3 0-64-28.7-64-64L16 64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64L80 64l0 320 224 0 0-320z"/></svg>
				SVG;
	}

	// ----------------CALENDER----------------------
	public static function calender(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"/></svg>
				</svg>
				SVG;
	}
	// ----------------
	public static function calenderLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M216 64C229.3 64 240 74.7 240 88L240 128L400 128L400 88C400 74.7 410.7 64 424 64C437.3 64 448 74.7 448 88L448 128L480 128C515.3 128 544 156.7 544 192L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 192C96 156.7 124.7 128 160 128L192 128L192 88C192 74.7 202.7 64 216 64zM480 496C488.8 496 496 488.8 496 480L496 416L408 416L408 496L480 496zM496 368L496 288L408 288L408 368L496 368zM360 368L360 288L280 288L280 368L360 368zM232 368L232 288L144 288L144 368L232 368zM144 416L144 480C144 488.8 151.2 496 160 496L232 496L232 416L144 416zM280 416L280 496L360 496L360 416L280 416zM216 176L160 176C151.2 176 144 183.2 144 192L144 240L496 240L496 192C496 183.2 488.8 176 480 176L216 176z"/></svg>
				SVG;
	}

	// ----------------BELLS----------------------
	public static function bell(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416l384 0c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8l0-18.8c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
				SVG;
	}
	// ----------------
	public static function bellSlash(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" $attrString fill="currentColor"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7l-90.2-70.7c.2-.4 .4-.9 .6-1.3c5.2-11.5 3.1-25-5.3-34.4l-7.4-8.3C497.3 319.2 480 273.9 480 226.8l0-18.8c0-77.4-55-142-128-156.8L352 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 19.2c-42.6 8.6-79 34.2-102 69.3L38.8 5.1zM406.2 416L160 222.1l0 4.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S115.4 416 128 416l278.2 0zm-40.9 77.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
				SVG;
	}

	// ----------------CHEVRON/ARROWS----------------------
	public static function chevronUp(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M297.4 169.4C309.9 156.9 330.2 156.9 342.7 169.4L534.7 361.4C547.2 373.9 547.2 394.2 534.7 406.7C522.2 419.2 501.9 419.2 489.4 406.7L320 237.3L150.6 406.6C138.1 419.1 117.8 419.1 105.3 406.6C92.8 394.1 92.8 373.8 105.3 361.3L297.3 169.3z"/></svg>
				SVG;
	}
	// ----------------
	public static function chevronDown(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M297.4 470.6C309.9 483.1 330.2 483.1 342.7 470.6L534.7 278.6C547.2 266.1 547.2 245.8 534.7 233.3C522.2 220.8 501.9 220.8 489.4 233.3L320 402.7L150.6 233.4C138.1 220.9 117.8 220.9 105.3 233.4C92.8 245.9 92.8 266.2 105.3 278.7L297.3 470.7z"/></svg>
				SVG;
	}
	// ----------------
	public static function chevronRight(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M471.1 297.4C483.6 309.9 483.6 330.2 471.1 342.7L279.1 534.7C266.6 547.2 246.3 547.2 233.8 534.7C221.3 522.2 221.3 501.9 233.8 489.4L403.2 320L233.9 150.6C221.4 138.1 221.4 117.8 233.9 105.3C246.4 92.8 266.7 92.8 279.2 105.3L471.2 297.3z"/></svg>
				SVG;
	}
	// ----------------
	public static function bracketRight(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"/></svg>
				SVG;
	}
	// ----------------
	public static function bracketLeft(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"$attrString fill="currentColor"><path d="M71 303.1C61.6 312.4 61.6 327.6 71 337L215 481C221.9 487.9 232.2 489.9 241.2 486.2C250.2 482.5 256 473.7 256 464L256 384L368 384C394.5 384 416 362.5 416 336L416 304C416 277.5 394.5 256 368 256L256 256L256 176C256 166.3 250.2 157.5 241.2 153.8C232.2 150.1 221.9 152.1 215 159L71 303.1zM416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L480 544C533 544 576 501 576 448L576 192C576 139 533 96 480 96L416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160C497.7 160 512 174.3 512 192L512 448C512 465.7 497.7 480 480 480L416 480z" /></svg>
				SVG;
	}
	// ----------------
	public static function chevronLeft(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M169.4 297.4C156.9 309.9 156.9 330.2 169.4 342.7L361.4 534.7C373.9 547.2 394.2 547.2 406.7 534.7C419.2 522.2 419.2 501.9 406.7 489.4L237.3 320L406.6 150.6C419.1 138.1 419.1 117.8 406.6 105.3C394.1 92.8 373.8 92.8 361.3 105.3L169.3 297.3z"/></svg>
				SVG;
	}


	// ----------------VEHICLES/TRANSPORT----------------------
	public static function car(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M199.2 181.4L173.1 256L466.9 256L440.8 181.4C436.3 168.6 424.2 160 410.6 160L229.4 160C215.8 160 203.7 168.6 199.2 181.4zM103.6 260.8L138.8 160.3C152.3 121.8 188.6 96 229.4 96L410.6 96C451.4 96 487.7 121.8 501.2 160.3L536.4 260.8C559.6 270.4 576 293.3 576 320L576 512C576 529.7 561.7 544 544 544L512 544C494.3 544 480 529.7 480 512L480 480L160 480L160 512C160 529.7 145.7 544 128 544L96 544C78.3 544 64 529.7 64 512L64 320C64 293.3 80.4 270.4 103.6 260.8zM192 368C192 350.3 177.7 336 160 336C142.3 336 128 350.3 128 368C128 385.7 142.3 400 160 400C177.7 400 192 385.7 192 368zM480 400C497.7 400 512 385.7 512 368C512 350.3 497.7 336 480 336C462.3 336 448 350.3 448 368C448 385.7 462.3 400 480 400z"/></svg>
				SVG;
	}
	// ----------------
	public static function taxy(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M256 64C238.3 64 224 78.3 224 96L224 128L215.1 128C173.1 128 136 155.3 123.5 195.4L100.5 268.9C78.5 283.1 64 307.9 64 336L64 512C64 529.7 78.3 544 96 544L128 544C145.7 544 160 529.7 160 512L160 480L480 480L480 512C480 529.7 494.3 544 512 544L544 544C561.7 544 576 529.7 576 512L576 336C576 307.9 561.5 283.1 539.6 268.9L516.6 195.4C504.1 155.3 466.9 128 424.9 128L416 128L416 96C416 78.3 401.7 64 384 64L256 64zM215.1 192L425 192C439 192 451.4 201.1 455.5 214.5L468.5 256L171.6 256L184.6 214.5C188.8 201.1 201.1 192 215.1 192zM160 336C177.7 336 192 350.3 192 368C192 385.7 177.7 400 160 400C142.3 400 128 385.7 128 368C128 350.3 142.3 336 160 336zM448 368C448 350.3 462.3 336 480 336C497.7 336 512 350.3 512 368C512 385.7 497.7 400 480 400C462.3 400 448 385.7 448 368z"/></svg>
				SVG;
	}
	// ----------------
	public static function pickupVan(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M32 160C32 124.7 60.7 96 96 96L384 96C419.3 96 448 124.7 448 160L448 192L498.7 192C515.7 192 532 198.7 544 210.7L589.3 256C601.3 268 608 284.3 608 301.3L608 448C608 483.3 579.3 512 544 512L540.7 512C530.3 548.9 496.3 576 456 576C415.7 576 381.8 548.9 371.3 512L268.7 512C258.3 548.9 224.3 576 184 576C143.7 576 109.8 548.9 99.3 512L96 512C60.7 512 32 483.3 32 448L32 160zM544 352L544 301.3L498.7 256L448 256L448 352L544 352zM224 488C224 465.9 206.1 448 184 448C161.9 448 144 465.9 144 488C144 510.1 161.9 528 184 528C206.1 528 224 510.1 224 488zM456 528C478.1 528 496 510.1 496 488C496 465.9 478.1 448 456 448C433.9 448 416 465.9 416 488C416 510.1 433.9 528 456 528z"/></svg>
				SVG;
	}
	// ----------------
	public static function pickupVanLined(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M96 144C87.2 144 80 151.2 80 160L80 448C80 456.8 87.2 464 96 464L99.3 464C109.7 427.1 143.7 400 184 400C224.3 400 258.2 427.1 268.7 464L371.3 464C376.2 446.6 386.4 431.3 400 420.1L400 160C400 151.2 392.8 144 384 144L96 144zM99.3 512L96 512C60.7 512 32 483.3 32 448L32 160C32 124.7 60.7 96 96 96L384 96C419.3 96 448 124.7 448 160L448 192L503.4 192C520.4 192 536.7 198.7 548.7 210.7L589.3 251.3C601.3 263.3 608 279.6 608 296.6L608 448C608 483.3 579.3 512 544 512L540.7 512C530.3 548.9 496.3 576 456 576C415.7 576 381.8 548.9 371.3 512L268.7 512C258.3 548.9 224.3 576 184 576C143.7 576 109.8 548.9 99.3 512zM448 320L560 320L560 296.6C560 292.4 558.3 288.3 555.3 285.3L514.7 244.7C511.7 241.7 507.6 240 503.4 240L448 240L448 320zM448 368L448 400.4C450.6 400.2 453.3 400 456 400C496.3 400 530.2 427.1 540.7 464L544 464C552.8 464 560 456.8 560 448L560 368L448 368zM184 528C206.1 528 224 510.1 224 488C224 465.9 206.1 448 184 448C161.9 448 144 465.9 144 488C144 510.1 161.9 528 184 528zM456 528C478.1 528 496 510.1 496 488C496 465.9 478.1 448 456 448C433.9 448 416 465.9 416 488C416 510.1 433.9 528 456 528z"/></svg>
				SVG;
	}
	// ----------------
	public static function pickupTruck(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M363.8 160L421.4 256L288 256L288 160L363.8 160zM496 256L418.6 127.1C407.1 107.8 386.2 96 363.8 96L256 96C238.3 96 224 110.3 224 128L224 256L80 256C53.5 256 32 277.5 32 304L32 384C14.3 384 0 398.3 0 416C0 433.7 14.3 448 32 448L64.4 448C64.2 450.6 64 453.3 64 456C64 504.6 103.4 544 152 544C200.6 544 240 504.6 240 456C240 453.3 239.9 450.6 239.6 448L400.3 448C400.1 450.6 399.9 453.3 399.9 456C399.9 504.6 439.3 544 487.9 544C536.5 544 575.9 504.6 575.9 456C575.9 453.3 575.8 450.6 575.5 448L607.9 448C625.6 448 639.9 433.7 639.9 416C639.9 398.3 625.6 384 607.9 384L607.9 304C607.9 277.5 586.4 256 559.9 256L495.9 256zM112 456C112 433.9 129.9 416 152 416C174.1 416 192 433.9 192 456C192 478.1 174.1 496 152 496C129.9 496 112 478.1 112 456zM488 416C510.1 416 528 433.9 528 456C528 478.1 510.1 496 488 496C465.9 496 448 478.1 448 456C448 433.9 465.9 416 488 416z"/></svg>
				SVG;
	}
	// ----------------
	public static function ambulance(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M96 96C60.7 96 32 124.7 32 160L32 448C32 483.3 60.7 512 96 512L99.3 512C109.7 548.9 143.7 576 184 576C224.3 576 258.2 548.9 268.7 512L371.3 512C381.7 548.9 415.7 576 456 576C496.3 576 530.2 548.9 540.7 512L544 512C579.3 512 608 483.3 608 448L608 301.3C608 284.3 601.3 268 589.3 256L544 210.7C532 198.7 515.7 192 498.7 192L448 192L448 160C448 124.7 419.3 96 384 96L96 96zM544 301.3L544 352L448 352L448 256L498.7 256L544 301.3zM184 448C206.1 448 224 465.9 224 488C224 510.1 206.1 528 184 528C161.9 528 144 510.1 144 488C144 465.9 161.9 448 184 448zM416 488C416 465.9 433.9 448 456 448C478.1 448 496 465.9 496 488C496 510.1 478.1 528 456 528C433.9 528 416 510.1 416 488zM208 200C208 191.2 215.2 184 224 184L256 184C264.8 184 272 191.2 272 200L272 240L312 240C320.8 240 328 247.2 328 256L328 288C328 296.8 320.8 304 312 304L272 304L272 344C272 352.8 264.8 360 256 360L224 360C215.2 360 208 352.8 208 344L208 304L168 304C159.2 304 152 296.8 152 288L152 256C152 247.2 159.2 240 168 240L208 240L208 200z"/></svg>
				SVG;
	}
	// ----------------
	public static function bycycle(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"> $attrString fill="currentColor"><path d="M331.7 107.3C336 100.3 343.7 96 352 96L456 96C469.3 96 480 106.7 480 120C480 133.3 469.3 144 456 144L390.4 144L462.6 292.4C473.3 289.5 484.5 288 496 288C566.7 288 624 345.3 624 416C624 486.7 566.7 544 496 544C425.3 544 368 486.7 368 416C368 374 388.2 336.8 419.4 313.4L399 271.5L325.5 418.5C323.2 423.3 319.2 427.3 314.1 429.7C313.5 430 312.9 430.2 312.3 430.4C309.4 431.5 306.4 432 303.4 431.9L271 432C263.1 495.1 209.3 544 144 544C73.3 544 16 486.7 16 416C16 345.3 73.3 288 144 288C154.8 288 165.2 289.3 175.2 291.8L203.7 234.9L192.2 208L152 208C138.7 208 128 197.3 128 184C128 170.7 138.7 160 152 160L208 160C217.6 160 226.3 165.7 230.1 174.5L244.4 208L368.1 208L330.4 130.5C326.8 123.1 327.2 114.3 331.6 107.3zM228.5 292.7L182.9 384L267.7 384L228.6 292.7zM305.7 351L353.2 256L265 256L305.7 351zM474.4 426.5L444.7 365.5C431.9 378.5 424 396.3 424 416C424 455.8 456.2 488 496 488C535.8 488 568 455.8 568 416C568 376.2 535.8 344 496 344C493.3 344 490.5 344.2 487.9 344.5L517.6 405.5C523.4 417.4 518.4 431.8 506.5 437.6C494.6 443.4 480.2 438.4 474.4 426.5zM149.2 432C129 432 115.8 410.7 124.9 392.6L149.1 344.1C147.4 344 145.7 343.9 144 343.9C104.2 343.9 72 376.1 72 415.9C72 455.7 104.2 487.9 144 487.9C178.3 487.9 206.9 464 214.2 431.9L149.2 431.9z"/></svg>
				SVG;
	}
	// ----------------
	public static function bike(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M256 104C256 90.7 266.7 80 280 80L352 80C361.4 80 369.9 85.4 373.8 93.9L392.3 134L416.4 117.6C421.7 114 428 112 434.4 112L504 112C517.3 112 528 122.7 528 136L528 216C528 229.3 517.3 240 504 240L441.2 240L465.1 291.8C475 289.3 485.3 288 496 288C566.7 288 624 345.3 624 416C624 486.7 566.7 544 496 544C425.3 544 368 486.7 368 416C368 373.1 389.1 335.1 421.5 311.9L408.5 283.7C369.5 311.2 344 356.7 344 408L344 416C344 421.8 341.9 427.2 338.4 431.4C334 436.7 327.4 440 320 440L269.8 440C258.6 499.2 206.5 544 144 544C73.3 544 16 486.7 16 416C16 345.3 73.3 288 144 288C206.5 288 258.5 332.8 269.8 392L295.2 392C287.2 315.6 222.6 256 144 256L88 256C74.7 256 64 245.3 64 232C64 218.7 74.7 208 88 208L144 208C180.6 208 214.8 217.8 244.3 234.9L352.1 161.4L336.6 128L280 128C266.7 128 256 117.3 256 104zM320 312.9C336.2 283.1 359.7 257.8 388.1 239.5L372.4 205.6L284.4 265.6C298.4 279.5 310.5 295.4 319.9 312.9zM419 192L480 192L480 160L439.4 160L412.7 178.2L419.1 192zM474.2 426.1L442.2 356.8C426.1 371.4 416 392.6 416 416C416 460.2 451.8 496 496 496C540.2 496 576 460.2 576 416C576 371.8 540.2 336 496 336C492.5 336 489.1 336.2 485.8 336.6L517.8 405.9C523.4 417.9 518.1 432.2 506.1 437.7C494.1 443.2 479.8 438 474.3 426zM220.3 440L144 440C130.7 440 120 429.3 120 416C120 402.7 130.7 392 144 392L220.3 392C210.1 359.5 179.8 336 144 336C99.8 336 64 371.8 64 416C64 460.2 99.8 496 144 496C179.8 496 210.1 472.5 220.3 440z"/></svg>
				SVG;
	}
	// ----------------
	public static function helicopter(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M208 96C194.7 96 184 106.7 184 120C184 133.3 194.7 144 208 144L360 144L360 192L139.2 192L106.4 152.6C101.9 147.2 95.1 144 88 144L56 144C47.7 144 40 148.3 35.6 155.4C31.2 162.5 30.8 171.3 34.5 178.8L82.5 274.8C86.6 282.9 94.9 288 104 288L211.8 288L315.8 431.1C330.9 451.8 354.9 464 380.5 464L456 464C531.1 464 592 403.1 592 328C592 252.9 531.1 192 456 192L408 192L408 144L560 144C573.3 144 584 133.3 584 120C584 106.7 573.3 96 560 96L208 96zM408 256L456 256C495.8 256 528 288.2 528 328C528 367.8 495.8 400 456 400L408 400L408 256zM584 480C570.7 480 560 490.7 560 504C560 508.4 556.4 512 552 512L280 512C266.7 512 256 522.7 256 536C256 549.3 266.7 560 280 560L552 560C582.9 560 608 534.9 608 504C608 490.7 597.3 480 584 480z"/></svg>
				SVG;
	}
	// ----------------
	public static function train(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M128 160C128 107 171 64 224 64L416 64C469 64 512 107 512 160L512 416C512 456.1 487.4 490.5 452.5 504.8L506.4 568.5C515 578.6 513.7 593.8 503.6 602.3C493.5 610.8 478.3 609.6 469.8 599.5L395.8 512L244.5 512L170.5 599.5C161.9 609.6 146.8 610.9 136.7 602.3C126.6 593.7 125.3 578.6 133.9 568.5L187.8 504.8C152.6 490.5 128 456.1 128 416L128 160zM192 192L192 288C192 305.7 206.3 320 224 320L296 320L296 160L224 160C206.3 160 192 174.3 192 192zM344 320L416 320C433.7 320 448 305.7 448 288L448 192C448 174.3 433.7 160 416 160L344 160L344 320zM224 448C241.7 448 256 433.7 256 416C256 398.3 241.7 384 224 384C206.3 384 192 398.3 192 416C192 433.7 206.3 448 224 448zM448 416C448 398.3 433.7 384 416 384C398.3 384 384 398.3 384 416C384 433.7 398.3 448 416 448C433.7 448 448 433.7 448 416z"/></svg>
				SVG;
	}
	// ----------------
	public static function bus(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"> $attrString fill="currentColor"><path d="M192 64C139 64 96 107 96 160L96 448C96 477.8 116.4 502.9 144 510L144 544C144 561.7 158.3 576 176 576L192 576C209.7 576 224 561.7 224 544L224 512L416 512L416 544C416 561.7 430.3 576 448 576L464 576C481.7 576 496 561.7 496 544L496 510C523.6 502.9 544 477.8 544 448L544 160C544 107 501 64 448 64L192 64zM160 240C160 222.3 174.3 208 192 208L296 208L296 320L192 320C174.3 320 160 305.7 160 288L160 240zM344 320L344 208L448 208C465.7 208 480 222.3 480 240L480 288C480 305.7 465.7 320 448 320L344 320zM192 384C209.7 384 224 398.3 224 416C224 433.7 209.7 448 192 448C174.3 448 160 433.7 160 416C160 398.3 174.3 384 192 384zM448 384C465.7 384 480 398.3 480 416C480 433.7 465.7 448 448 448C430.3 448 416 433.7 416 416C416 398.3 430.3 384 448 384zM248 136C248 122.7 258.7 112 272 112L368 112C381.3 112 392 122.7 392 136C392 149.3 381.3 160 368 160L272 160C258.7 160 248 149.3 248 136z"/></svg>
				SVG;
	}
	// ----------------
	public static function petrolPump(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"> $attrString fill="currentColor"><path d="M96 128C96 92.7 124.7 64 160 64L320 64C355.3 64 384 92.7 384 128L384 320L392 320C440.6 320 480 359.4 480 408L480 440C480 453.3 490.7 464 504 464C517.3 464 528 453.3 528 440L528 286C500.4 278.9 480 253.8 480 224L480 164.5L454.2 136.2C445.3 126.4 446 111.2 455.8 102.3C465.6 93.4 480.8 94.1 489.7 103.9L561.4 182.7C570.8 193 576 206.4 576 220.4L576 440C576 479.8 543.8 512 504 512C464.2 512 432 479.8 432 440L432 408C432 385.9 414.1 368 392 368L384 368L384 529.4C393.3 532.7 400 541.6 400 552C400 565.3 389.3 576 376 576L104 576C90.7 576 80 565.3 80 552C80 541.5 86.7 532.7 96 529.4L96 128zM160 144L160 240C160 248.8 167.2 256 176 256L304 256C312.8 256 320 248.8 320 240L320 144C320 135.2 312.8 128 304 128L176 128C167.2 128 160 135.2 160 144z"/></svg>
				SVG;
	}
	// ----------------
	public static function chargingStation(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M96 128C96 92.7 124.7 64 160 64L320 64C355.3 64 384 92.7 384 128L384 352C428.2 352 464 387.8 464 432L464 444C464 455 473 464 484 464C495 464 504 455 504 444L504 316.3C471.5 306.1 448 275.8 448 240L448 208C448 199.2 455.2 192 464 192L480 192L480 144C480 135.2 487.2 128 496 128C504.8 128 512 135.2 512 144L512 192L544 192L544 144C544 135.2 551.2 128 560 128C568.8 128 576 135.2 576 144L576 192L592 192C600.8 192 608 199.2 608 208L608 240C608 275.8 584.5 306.1 552 316.3L552 444C552 481.6 521.6 512 484 512C446.4 512 416 481.6 416 444L416 432C416 414.3 401.7 400 384 400L384 529.4C393.3 532.7 400 541.6 400 552C400 565.3 389.3 576 376 576L104 576C90.7 576 80 565.3 80 552C80 541.5 86.7 532.7 96 529.4L96 128zM178.7 253.7L217.7 253.7L196.8 320.6C194.4 328.2 200.1 336 208.1 336C211 336 213.7 335 215.9 333.1L310.5 251.1C313.6 248.4 315.4 244.5 315.4 240.4C315.4 232.6 309.1 226.3 301.3 226.3L262.3 226.3L283.2 159.4C285.6 151.8 279.9 144 271.9 144C269 144 266.3 145 264.1 146.9L169.5 228.9C166.4 231.6 164.6 235.5 164.6 239.6C164.6 247.4 170.9 253.7 178.7 253.7z"/></svg>
				SVG;
	}
	// ----------------
	public static function crash(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M320 32C333.3 32 344 42.7 344 56L344 104C344 117.3 333.3 128 320 128C306.7 128 296 117.3 296 104L296 56C296 42.7 306.7 32 320 32zM320 192C332.4 192 342.7 201.4 343.9 213.7L357.4 355.6L531.6 75.3C538.3 64.6 552.1 60.8 563.3 66.8C574.5 72.8 579.1 86.3 573.9 97.8L436.8 402.6C439 404.9 441.1 407.3 443.1 409.7L540.3 355C550.8 349.1 563.9 351.9 571.2 361.4C578.5 370.9 577.5 384.4 569 392.9L482 479.9L410.6 479.9C397.4 442.6 361.9 415.9 320.1 415.9C278.3 415.9 242.7 442.6 229.6 479.9L150 479.9L74.5 427.6C64.6 421 61.2 408.1 66.4 397.5C71.6 386.9 83.8 381.6 95.1 385.1L192.3 415.5C195.3 411.6 198.4 407.9 201.7 404.2L139.4 300.3C133.3 290.2 135.5 277.2 144.5 269.6C153.5 262 166.7 262.1 175.6 269.7L278 357.6C279.5 357.2 281 356.8 282.5 356.5L296.1 213.8C297.3 201.5 307.6 192.1 320 192.1zM96 528L552 528C565.3 528 576 538.7 576 552C576 565.3 565.3 576 552 576L88 576C74.7 576 64 565.3 64 552C64 538.7 74.7 528 88 528L96 528z"/></svg>
				SVG;
	}
	// ----------------
	public static function carAccident(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M232 80.1L232 32.1C232 18.8 221.3 8.1 208 8.1C194.7 8.1 184 18.8 184 32.1L184 80.1C184 93.4 194.7 104.1 208 104.1C221.3 104.1 232 93.4 232 80.1zM32 232.1L80 232.1C93.3 232.1 104 221.4 104 208.1C104 194.8 93.3 184.1 80 184.1L32 184.1C18.7 184.1 8 194.8 8 208.1C8 221.4 18.7 232.1 32 232.1zM281.5 134.6C290.9 144 306.1 144 315.4 134.6L349.3 100.7C358.7 91.3 358.7 76.1 349.3 66.8C339.9 57.5 324.7 57.4 315.4 66.8L281.5 100.6C272.1 110 272.1 125.2 281.5 134.5zM100.5 349.6L134.4 315.7C143.8 306.3 143.8 291.1 134.4 281.8C125 272.5 109.8 272.4 100.5 281.8L66.6 315.6C57.2 325 57.2 340.2 66.6 349.5C76 358.8 91.2 358.9 100.5 349.5zM66.6 66.7C57.2 76.1 57.2 91.3 66.6 100.6L100.5 134.5C109.9 143.9 125.1 143.9 134.4 134.5C143.7 125.1 143.8 109.9 134.4 100.6L100.5 66.7C91.1 57.3 76 57.3 66.6 66.7zM352.9 239.4L505 280.2C511.4 281.9 516.1 287.5 516.8 294.1L524 368.1L292.5 306.1L335.7 245.6C339.6 240.2 346.4 237.7 352.9 239.4zM223.6 292.5L221.5 295.4C199.8 300.9 181.6 317.7 175.4 340.9C171.3 356.4 163 387.3 150.6 433.6L142.3 464.5C137.7 481.6 147.9 499.1 164.9 503.7L180.4 507.8C197.5 512.4 215 502.2 219.6 485.2L227.9 454.3L506.1 528.8L497.8 559.7C493.2 576.8 503.4 594.3 520.4 598.9L535.9 603C553 607.6 570.5 597.4 575.1 580.4C579.2 564.9 587.5 534 599.9 487.7L608.2 456.8C614.4 433.6 607.1 410 591 394.3L590.7 390.7L580.7 287.7C577.5 254.5 554 226.8 521.8 218.2L369.5 177.6C337.3 169 303.1 181.2 283.7 208.4L223.5 292.6zM272.3 350.3C283.5 353.1 292.3 361.7 295.4 372.9C298.4 384.1 295.2 396 287 404.1C278.8 412.2 266.8 415.3 255.7 412.1C244.5 409.3 235.7 400.7 232.6 389.5C229.6 378.3 232.8 366.4 241 358.3C249.2 350.2 261.2 347.1 272.3 350.3zM480.4 439.2C483.2 428 491.8 419.2 503 416.1C514.2 413.1 526.1 416.3 534.2 424.5C542.3 432.7 545.4 444.7 542.2 455.8C539.4 467 530.8 475.8 519.6 478.9C508.4 481.9 496.5 478.7 488.4 470.5C480.3 462.3 477.2 450.3 480.4 439.2z"/></svg>
				SVG;
	}
	// ----------------



	// ----------------SERVICE/REPAIR/GARRAGE/FIX----------------------

	public static function hammer(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M246.9 82.3L271 67.8C292.6 54.8 317.3 48 342.5 48C379.3 48 414.7 62.6 440.7 88.7L504.6 152.6C519.6 167.6 528 188 528 209.2L528 240.1L547.7 259.8L547.7 259.8C563.3 244.2 588.6 244.2 604.3 259.8C620 275.4 619.9 300.7 604.3 316.4L540.3 380.4C524.7 396 499.4 396 483.7 380.4C468 364.8 468.1 339.5 483.7 323.8L464 304L433.1 304C411.9 304 391.5 295.6 376.5 280.6L327.4 231.5C312.4 216.5 304 196.1 304 174.9L304 162.2C304 151 298.1 140.5 288.5 134.8L246.9 109.8C236.5 103.6 236.5 88.6 246.9 82.4zM50.7 466.7L272.8 244.6L363.3 335.1L141.2 557.2C116.2 582.2 75.7 582.2 50.7 557.2C25.7 532.2 25.7 491.7 50.7 466.7z"/></svg>
				SVG;
	}
	// ----------------
	public static function toolbox(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"> $attrString fill="currentColor"><path d="M248 112L392 112C396.4 112 400 115.6 400 120L400 160L240 160L240 120C240 115.6 243.6 112 248 112zM192 120L192 160L163.9 160C151.2 160 139 165.1 130 174.1L78.1 225.9C69.1 234.9 64 247.1 64 259.8L64 480C64 515.3 92.7 544 128 544L512 544C547.3 544 576 515.3 576 480L576 259.9C576 247.2 570.9 235 561.9 226L510 174.1C501 165.1 488.8 160 476.1 160L448 160L448 120C448 89.1 422.9 64 392 64L248 64C217.1 64 192 89.1 192 120zM112 384L200 384L200 400C200 413.3 210.7 424 224 424C237.3 424 248 413.3 248 400L248 384L392 384L392 400C392 413.3 402.7 424 416 424C429.3 424 440 413.3 440 400L440 384L528 384L528 480C528 488.8 520.8 496 512 496L128 496C119.2 496 112 488.8 112 480L112 384zM112 336L112 259.9L163.9 208L476.1 208L528 259.9L528 336L440 336L440 320C440 306.7 429.3 296 416 296C402.7 296 392 306.7 392 320L392 336L248 336L248 320C248 306.7 237.3 296 224 296C210.7 296 200 306.7 200 320L200 336L112 336z"/></svg>
				SVG;
	}
	// ----------------
	public static function repair(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M102.8 57.3C108.2 51.9 116.6 51.1 123 55.3L241.9 134.5C250.8 140.4 256.1 150.4 256.1 161.1L256.1 210.7L346.9 301.5C380.2 286.5 420.8 292.6 448.1 320L574.2 446.1C592.9 464.8 592.9 495.2 574.2 514L514.1 574.1C495.4 592.8 465 592.8 446.2 574.1L320.1 448C292.7 420.6 286.6 380.1 301.6 346.8L210.8 256L161.2 256C150.5 256 140.5 250.7 134.6 241.8L55.4 122.9C51.2 116.6 52 108.1 57.4 102.7L102.8 57.3zM247.8 360.8C241.5 397.7 250.1 436.7 274 468L179.1 563C151 591.1 105.4 591.1 77.3 563C49.2 534.9 49.2 489.3 77.3 461.2L212.7 325.7L247.9 360.8zM416.1 64C436.2 64 455.5 67.7 473.2 74.5C483.2 78.3 485 91 477.5 98.6L420.8 155.3C417.8 158.3 416.1 162.4 416.1 166.6L416.1 208C416.1 216.8 423.3 224 432.1 224L473.5 224C477.7 224 481.8 222.3 484.8 219.3L541.5 162.6C549.1 155.1 561.8 156.9 565.6 166.9C572.4 184.6 576.1 203.9 576.1 224C576.1 267.2 558.9 306.3 531.1 335.1L482 286C448.9 253 403.5 240.3 360.9 247.6L304.1 190.8L304.1 161.1L303.9 156.1C303.1 143.7 299.5 131.8 293.4 121.2C322.8 86.2 366.8 64 416.1 63.9z"/></svg>
				SVG;
	}
	// ----------------



	// ----------------CLOSE/OFF----------------------
	public static function closeX(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z"/></svg>
				SVG;
	}
	// ----------------
	public static function closeXround(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM231 231C240.4 221.6 255.6 221.6 264.9 231L319.9 286L374.9 231C384.3 221.6 399.5 221.6 408.8 231C418.1 240.4 418.2 255.6 408.8 264.9L353.8 319.9L408.8 374.9C418.2 384.3 418.2 399.5 408.8 408.8C399.4 418.1 384.2 418.2 374.9 408.8L319.9 353.8L264.9 408.8C255.5 418.2 240.3 418.2 231 408.8C221.7 399.4 221.6 384.2 231 374.9L286 319.9L231 264.9C221.6 255.5 221.6 240.3 231 231z"/></svg>
				SVG;
	}

	// ----------------DOCUMENT/BOOK/PAPER----------------------

	public static function document(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M128 128C128 92.7 156.7 64 192 64L341.5 64C358.5 64 374.8 70.7 386.8 82.7L493.3 189.3C505.3 201.3 512 217.6 512 234.6L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM336 122.5L336 216C336 229.3 346.7 240 360 240L453.5 240L336 122.5zM248 320C234.7 320 224 330.7 224 344C224 357.3 234.7 368 248 368L392 368C405.3 368 416 357.3 416 344C416 330.7 405.3 320 392 320L248 320zM248 416C234.7 416 224 426.7 224 440C224 453.3 234.7 464 248 464L392 464C405.3 464 416 453.3 416 440C416 426.7 405.3 416 392 416L248 416z"/></svg>
				SVG;
	}
	// ----------------
	public static function documentLines(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M192 112L304 112L304 200C304 239.8 336.2 272 376 272L464 272L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 128C176 119.2 183.2 112 192 112zM352 131.9L444.1 224L376 224C362.7 224 352 213.3 352 200L352 131.9zM192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 250.5C512 233.5 505.3 217.2 493.3 205.2L370.7 82.7C358.7 70.7 342.5 64 325.5 64L192 64zM248 320C234.7 320 224 330.7 224 344C224 357.3 234.7 368 248 368L392 368C405.3 368 416 357.3 416 344C416 330.7 405.3 320 392 320L248 320zM248 416C234.7 416 224 426.7 224 440C224 453.3 234.7 464 248 464L392 464C405.3 464 416 453.3 416 440C416 426.7 405.3 416 392 416L248 416z"/></svg>
				SVG;
	}
	// ----------------
	public static function file(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" $attrString fill="currentColor"><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z"/></svg>
				SVG;
	}
	// ----------------
	public static function form(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M544 139.2L544 500.9C544 525.2 525 544.1 500.8 544.1L139.2 544.1C115.3 544 96 525.4 96 500.8L96 139.2C96 115.1 114.8 96 139.2 96L500.9 96C524.9 96 544 114.8 544 139.2zM506.7 500.8L506.7 139.2C506.7 136.2 504.1 133.4 500.9 133.4L491.6 133.4L381.3 208L320 158.1L258.8 208L148.5 133.3L139.2 133.3C136 133.3 133.4 136.1 133.4 139.1L133.4 500.8C133.4 503.8 136 506.6 139.2 506.6L500.9 506.6C504.1 506.7 506.7 503.9 506.7 500.8zM246.2 250L246.2 287L172.7 287L172.7 250L246.2 250zM246.2 324.4L246.2 361.7L172.7 361.7L172.7 324.4L246.2 324.4zM257.3 177.1L311.3 133.4L192.8 133.4L257.3 177.1zM467.3 250L467.3 287L271.3 287L271.3 250L467.3 250zM467.3 324.4L467.3 361.7L271.3 361.7L271.3 324.4L467.3 324.4zM382.7 177.1L447.2 133.4L328.8 133.4L382.7 177.1zM467.3 399L467.3 436.3L367.9 436.3L367.9 399L467.3 399z"/></svg>
				SVG;
	}
	// ----------------
	public static function ribbon(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M341.9 38.1C328.5 29.9 311.6 29.9 298.2 38.1C273.8 53 258.7 57 230.1 56.4C214.4 56 199.8 64.5 192.2 78.3C178.5 103.4 167.4 114.5 142.3 128.2C128.5 135.7 120.1 150.4 120.4 166.1C121.1 194.7 117 209.8 102.1 234.2C93.9 247.6 93.9 264.5 102.1 277.9C117 302.3 121 317.4 120.4 346C120 361.7 128.5 376.3 142.3 383.9C164.4 396 175.6 406 187.4 425.4L138.7 522.5C132.8 534.4 137.6 548.8 149.4 554.7L235.4 597.7C246.9 603.4 260.9 599.1 267.1 587.9L319.9 492.8L372.7 587.9C378.9 599.1 392.9 603.5 404.4 597.7L490.4 554.7C502.3 548.8 507.1 534.4 501.1 522.5L452.5 425.3C464.2 405.9 475.5 395.9 497.6 383.8C511.4 376.3 519.8 361.6 519.5 345.9C518.8 317.3 522.9 302.2 537.8 277.8C546 264.4 546 247.5 537.8 234.1C522.9 209.7 518.9 194.6 519.5 166C519.9 150.3 511.4 135.7 497.6 128.1C472.5 114.4 461.4 103.3 447.7 78.2C440.2 64.4 425.5 56 409.8 56.3C381.2 57 366.1 52.9 341.7 38zM320 160C373 160 416 203 416 256C416 309 373 352 320 352C267 352 224 309 224 256C224 203 267 160 320 160z"/></svg>
				SVG;
	}
	// ----------------
	public static function pdf(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M128 64C92.7 64 64 92.7 64 128L64 512C64 547.3 92.7 576 128 576L208 576L208 464C208 428.7 236.7 400 272 400L448 400L448 234.5C448 217.5 441.3 201.2 429.3 189.2L322.7 82.7C310.7 70.7 294.5 64 277.5 64L128 64zM389.5 240L296 240C282.7 240 272 229.3 272 216L272 122.5L389.5 240zM272 444C261 444 252 453 252 464L252 592C252 603 261 612 272 612C283 612 292 603 292 592L292 564L304 564C337.1 564 364 537.1 364 504C364 470.9 337.1 444 304 444L272 444zM304 524L292 524L292 484L304 484C315 484 324 493 324 504C324 515 315 524 304 524zM400 444C389 444 380 453 380 464L380 592C380 603 389 612 400 612L432 612C460.7 612 484 588.7 484 560L484 496C484 467.3 460.7 444 432 444L400 444zM420 572L420 484L432 484C438.6 484 444 489.4 444 496L444 560C444 566.6 438.6 572 432 572L420 572zM508 464L508 592C508 603 517 612 528 612C539 612 548 603 548 592L548 548L576 548C587 548 596 539 596 528C596 517 587 508 576 508L548 508L548 484L576 484C587 484 596 475 596 464C596 453 587 444 576 444L528 444C517 444 508 453 508 464z"/></svg>
        </svg>
    SVG;
	}
	// ----------------

	public static function pdfLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" $attrString fill="currentColor"><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg>
				SVG;
	}
	// ----------------
	public static function word(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M128 128C128 92.7 156.7 64 192 64L341.5 64C358.5 64 374.8 70.7 386.8 82.7L493.3 189.3C505.3 201.3 512 217.6 512 234.6L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM336 122.5L336 216C336 229.3 346.7 240 360 240L453.5 240L336 122.5zM263.4 338.8C260.5 325.9 247.7 317.7 234.8 320.6C221.9 323.5 213.7 336.3 216.6 349.2L248.6 493.2C250.9 503.7 260 511.4 270.8 512C281.6 512.6 291.4 505.9 294.8 495.6L320 419.9L345.2 495.6C348.6 505.8 358.4 512.5 369.2 512C380 511.5 389.1 503.8 391.4 493.2L423.4 349.2C426.3 336.3 418.1 323.4 405.2 320.6C392.3 317.8 379.4 325.9 376.6 338.8L363.4 398.2L342.8 336.4C339.5 326.6 330.4 320 320 320C309.6 320 300.5 326.6 297.2 336.4L276.6 398.2L263.4 338.8z"/></svg>
				SVG;
	}
	// ----------------
	public static function wordLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M192 112L304 112L304 200C304 239.8 336.2 272 376 272L464 272L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 128C176 119.2 183.2 112 192 112zM352 131.9L444.1 224L376 224C362.7 224 352 213.3 352 200L352 131.9zM192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 250.5C512 233.5 505.3 217.2 493.3 205.2L370.7 82.7C358.7 70.7 342.5 64 325.5 64L192 64zM263.3 338.2C260.1 325.3 247.1 317.5 234.2 320.7C221.3 323.9 213.5 337 216.7 349.8L248.7 477.8C251.2 488 260.1 495.3 270.6 495.9C281.1 496.5 290.7 490.2 294.4 480.4L319.9 412.3L345.4 480.4C349.1 490.2 358.7 496.5 369.2 495.9C379.7 495.3 388.6 488 391.1 477.8L423.1 349.8C426.3 336.9 418.5 323.9 405.6 320.7C392.7 317.5 379.7 325.3 376.5 338.2L363.2 391.4L342.3 335.6C339 326.2 330 320 320 320C310 320 301 326.2 297.5 335.6L276.6 391.4L263.3 338.2z"/></svg>
				SVG;
	}
	// ----------------
	public static function excel(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M128 128C128 92.7 156.7 64 192 64L341.5 64C358.5 64 374.8 70.7 386.8 82.7L493.3 189.3C505.3 201.3 512 217.6 512 234.6L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM336 122.5L336 216C336 229.3 346.7 240 360 240L453.5 240L336 122.5zM292 330.7C284.6 319.7 269.7 316.7 258.7 324C247.7 331.3 244.7 346.3 252 357.3L291.2 416L252 474.7C244.6 485.7 247.6 500.6 258.7 508C269.8 515.4 284.6 512.4 292 501.3L320 459.3L348 501.3C355.4 512.3 370.3 515.3 381.3 508C392.3 500.7 395.3 485.7 388 474.7L348.8 416L388 357.3C395.4 346.3 392.4 331.4 381.3 324C370.2 316.6 355.4 319.6 348 330.7L320 372.7L292 330.7z"/></svg>
				SVG;
	}
	// ----------------
	public static function excelLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M192 112L304 112L304 200C304 239.8 336.2 272 376 272L464 272L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 128C176 119.2 183.2 112 192 112zM352 131.9L444.1 224L376 224C362.7 224 352 213.3 352 200L352 131.9zM192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 250.5C512 233.5 505.3 217.2 493.3 205.2L370.7 82.7C358.7 70.7 342.5 64 325.5 64L192 64zM291.2 329.6C283.2 319 268.2 316.8 257.6 324.8C247 332.8 244.8 347.8 252.8 358.4L290 408L252.8 457.6C244.8 468.2 247 483.2 257.6 491.2C268.2 499.2 283.2 497 291.2 486.4L320 448L348.8 486.4C356.8 497 371.8 499.2 382.4 491.2C393 483.2 395.2 468.2 387.2 457.6L350 408L387.2 358.4C395.2 347.8 393 332.8 382.4 324.8C371.8 316.8 356.8 319 348.8 329.6L320 368L291.2 329.6z"/></svg>
				SVG;
	}
	// ----------------
	public static function csv(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M128 64C92.7 64 64 92.7 64 128L64 512C64 547.3 92.7 576 128 576L208 576L208 464C208 428.7 236.7 400 272 400L448 400L448 234.5C448 217.5 441.3 201.2 429.3 189.2L322.7 82.7C310.7 70.7 294.5 64 277.5 64L128 64zM389.5 240L296 240C282.7 240 272 229.3 272 216L272 122.5L389.5 240zM296 444C271.7 444 252 463.7 252 488L252 568C252 592.3 271.7 612 296 612L312 612C336.3 612 356 592.3 356 568L356 560C356 549 347 540 336 540C325 540 316 549 316 560L316 568C316 570.2 314.2 572 312 572L296 572C293.8 572 292 570.2 292 568L292 488C292 485.8 293.8 484 296 484L312 484C314.2 484 316 485.8 316 488L316 496C316 507 325 516 336 516C347 516 356 507 356 496L356 488C356 463.7 336.3 444 312 444L296 444zM432 444C403.3 444 380 467.3 380 496C380 524.7 403.3 548 432 548C438.6 548 444 553.4 444 560C444 566.6 438.6 572 432 572L400 572C389 572 380 581 380 592C380 603 389 612 400 612L432 612C460.7 612 484 588.7 484 560C484 531.3 460.7 508 432 508C425.4 508 420 502.6 420 496C420 489.4 425.4 484 432 484L456 484C467 484 476 475 476 464C476 453 467 444 456 444L432 444zM528 444C517 444 508 453 508 464L508 495.6C508 531.1 518.5 565.9 538.2 595.4L543.3 603.1C547 608.7 553.3 612 559.9 612C566.5 612 572.8 608.7 576.5 603.1L581.6 595.4C601.3 565.8 611.8 531.1 611.8 495.6L611.8 464C611.8 453 602.8 444 591.8 444C580.8 444 571.8 453 571.8 464L571.8 495.6C571.8 515.2 567.7 534.5 559.8 552.3C551.9 534.5 547.8 515.2 547.8 495.6L547.8 464C547.8 453 538.8 444 527.8 444z"/></svg>
				SVG;
	}
	// ----------------
	public static function powerpoint(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M128 128C128 92.7 156.7 64 192 64L341.5 64C358.5 64 374.8 70.7 386.8 82.7L493.3 189.3C505.3 201.3 512 217.6 512 234.6L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM336 122.5L336 216C336 229.3 346.7 240 360 240L453.5 240L336 122.5zM280 320C266.7 320 256 330.7 256 344L256 488C256 501.3 266.7 512 280 512C293.3 512 304 501.3 304 488L304 464L328 464C367.8 464 400 431.8 400 392C400 352.2 367.8 320 328 320L280 320zM328 416L304 416L304 368L328 368C341.3 368 352 378.7 352 392C352 405.3 341.3 416 328 416z"/></svg>
				SVG;
	}
	// ----------------
	public static function powerpointLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M192 112L304 112L304 200C304 239.8 336.2 272 376 272L464 272L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 128C176 119.2 183.2 112 192 112zM352 131.9L444.1 224L376 224C362.7 224 352 213.3 352 200L352 131.9zM192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 250.5C512 233.5 505.3 217.2 493.3 205.2L370.7 82.7C358.7 70.7 342.5 64 325.5 64L192 64zM280 320C266.7 320 256 330.7 256 344L256 472C256 485.3 266.7 496 280 496C293.3 496 304 485.3 304 472L304 456L332 456C369.6 456 400 425.6 400 388C400 350.4 369.6 320 332 320L280 320zM332 408L304 408L304 368L332 368C343 368 352 377 352 388C352 399 343 408 332 408z"/></svg>
				SVG;
	}
	// ----------------
	public static function book(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" $attrString fill="currentColor"><path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
				SVG;
	}
	// ----------------
	public static function list(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M197.8 100.3C208.7 107.9 211.3 122.9 203.7 133.7L147.7 213.7C143.6 219.5 137.2 223.2 130.1 223.8C123 224.4 116 222 111 217L71 177C61.7 167.6 61.7 152.4 71 143C80.3 133.6 95.6 133.7 105 143L124.8 162.8L164.4 106.2C172 95.3 187 92.7 197.8 100.3zM197.8 260.3C208.7 267.9 211.3 282.9 203.7 293.7L147.7 373.7C143.6 379.5 137.2 383.2 130.1 383.8C123 384.4 116 382 111 377L71 337C61.6 327.6 61.6 312.4 71 303.1C80.4 293.8 95.6 293.7 104.9 303.1L124.7 322.9L164.3 266.3C171.9 255.4 186.9 252.8 197.7 260.4zM288 160C288 142.3 302.3 128 320 128L544 128C561.7 128 576 142.3 576 160C576 177.7 561.7 192 544 192L320 192C302.3 192 288 177.7 288 160zM288 320C288 302.3 302.3 288 320 288L544 288C561.7 288 576 302.3 576 320C576 337.7 561.7 352 544 352L320 352C302.3 352 288 337.7 288 320zM224 480C224 462.3 238.3 448 256 448L544 448C561.7 448 576 462.3 576 480C576 497.7 561.7 512 544 512L256 512C238.3 512 224 497.7 224 480zM128 440C150.1 440 168 457.9 168 480C168 502.1 150.1 520 128 520C105.9 520 88 502.1 88 480C88 457.9 105.9 440 128 440z"/></svg>
				SVG;
	}

	// ----------------
	public static function listLined(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M197.8 100.3C208.7 107.9 211.3 122.9 203.7 133.7L147.7 213.7C143.6 219.5 137.2 223.2 130.1 223.8C123 224.4 116 222 111 217L71 177C61.7 167.6 61.7 152.4 71 143C80.3 133.6 95.6 133.7 105 143L124.8 162.8L164.4 106.2C172 95.3 187 92.7 197.8 100.3zM197.8 260.3C208.7 267.9 211.3 282.9 203.7 293.7L147.7 373.7C143.6 379.5 137.2 383.2 130.1 383.8C123 384.4 116 382 111 377L71 337C61.6 327.6 61.6 312.4 71 303.1C80.4 293.8 95.6 293.7 104.9 303.1L124.7 322.9L164.3 266.3C171.9 255.4 186.9 252.8 197.7 260.4zM288 160C288 142.3 302.3 128 320 128L544 128C561.7 128 576 142.3 576 160C576 177.7 561.7 192 544 192L320 192C302.3 192 288 177.7 288 160zM288 320C288 302.3 302.3 288 320 288L544 288C561.7 288 576 302.3 576 320C576 337.7 561.7 352 544 352L320 352C302.3 352 288 337.7 288 320zM224 480C224 462.3 238.3 448 256 448L544 448C561.7 448 576 462.3 576 480C576 497.7 561.7 512 544 512L256 512C238.3 512 224 497.7 224 480zM128 440C150.1 440 168 457.9 168 480C168 502.1 150.1 520 128 520C105.9 520 88 502.1 88 480C88 457.9 105.9 440 128 440z"/>
        </svg>
    SVG;
	}



	// ----------------CURRENCY/BANK----------------------
	public static function dollar(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M296 88C296 74.7 306.7 64 320 64C333.3 64 344 74.7 344 88L344 128L400 128C417.7 128 432 142.3 432 160C432 177.7 417.7 192 400 192L285.1 192C260.2 192 240 212.2 240 237.1C240 259.6 256.5 278.6 278.7 281.8L370.3 294.9C424.1 302.6 464 348.6 464 402.9C464 463.2 415.1 512 354.9 512L344 512L344 552C344 565.3 333.3 576 320 576C306.7 576 296 565.3 296 552L296 512L224 512C206.3 512 192 497.7 192 480C192 462.3 206.3 448 224 448L354.9 448C379.8 448 400 427.8 400 402.9C400 380.4 383.5 361.4 361.3 358.2L269.7 345.1C215.9 337.5 176 291.4 176 237.1C176 176.9 224.9 128 285.1 128L296 128L296 88z"/></svg>
				SVG;
	}
	// ----------------
	public static function dollarSack(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M392 176L248 176L210.7 101.5C208.9 97.9 208 93.9 208 89.9C208 75.6 219.6 64 233.9 64L406.1 64C420.4 64 432 75.6 432 89.9C432 93.9 431.1 97.9 429.3 101.5L392 176zM233.6 224L406.4 224L455.1 264.6C521.6 320 560 402 560 488.5C560 536.8 520.8 576 472.5 576L167.4 576C119.2 576 80 536.8 80 488.5C80 402 118.4 320 184.9 264.6L233.6 224zM324 288C313 288 304 297 304 308L304 312C275.2 312.3 252 335.7 252 364.5C252 390.2 270.5 412.1 295.9 416.3L337.6 423.3C343.6 424.3 348 429.5 348 435.6C348 442.5 342.4 448.1 335.5 448.1L280 448C269 448 260 457 260 468C260 479 269 488 280 488L304 488L304 492C304 503 313 512 324 512C335 512 344 503 344 492L344 487.3C369 483.2 388 461.6 388 435.5C388 409.8 369.5 387.9 344.1 383.7L302.4 376.7C296.4 375.7 292 370.5 292 364.4C292 357.5 297.6 351.9 304.5 351.9L352 351.9C363 351.9 372 342.9 372 331.9C372 320.9 363 311.9 352 311.9L344 311.9L344 307.9C344 296.9 335 287.9 324 287.9z"/></svg>
				SVG;
	}
	// ----------------
	public static function dollarSackLine(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="none" stroke="currentColor" stroke-width="32" stroke-linecap="round" stroke-linejoin="round" $attrString fill="currentColor"><path d="M392 176H248L210.7 101.5C208.9 97.9 208 93.9 208 89.9C208 75.6 219.6 64 233.9 64H406.1C420.4 64 432 75.6 432 89.9C432 93.9 431.1 97.9 429.3 101.5L392 176Z" /><path d="M233.6 224H406.4L455.1 264.6C521.6 320 560 402 560 488.5C560 536.8 520.8 576 472.5 576H167.4C119.2 576 80 536.8 80 488.5C80 402 118.4 320 184.9 264.6L233.6 224Z" /><path d="M324 288V312M324 492V487.3M304 312C275.2 312.3 252 335.7 252 364.5C252 390.2 270.5 412.1 295.9 416.3L337.6 423.3C343.6 424.3 348 429.5 348 435.6C348 442.5 342.4 448.1 335.5 448.1H280C269 448 260 457 260 468C260 479 269 488 280 488H344C369 483.2 388 461.6 388 435.5C388 409.8 369.5 387.9 344.1 383.7L302.4 376.7C296.4 375.7 292 370.5 292 364.4C292 357.5 297.6 351.9 304.5 351.9H352C363 351.9 372 342.9 372 331.9C372 320.9 363 311.9 352 311.9H304" /></svg>
				SVG;
	}
	// ----------------

	// ----------------SETTINGS----------------------

	public static function lightMode(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
						viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
						stroke-linecap="round" stroke-linejoin="round" class="size-4 shrink-0" $attrString>
						<circle cx="12" cy="12" r="4" />
						<path d="M12 3v1" />
						<path d="M12 20v1" />
						<path d="M3 12h1" />
						<path d="M20 12h1" />
						<path d="m18.364 5.636-.707.707" />
						<path d="m6.343 17.657-.707.707" />
						<path d="m5.636 5.636.707.707" />
						<path d="m17.657 17.657.707.707" />
					</svg>
					SVG;
	}
	// ----------------
	public static function darkMode(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
						viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
						stroke-linecap="round" stroke-linejoin="round" class="size-4 shrink-0" $attrString>
						<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
					</svg>
					SVG;
	}

	// ----------------
	public static function monitor(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
					viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
					stroke-linecap="round" stroke-linejoin="round" class="size-4 shrink-0" $attrString>
					<rect width="20" height="14" x="2" y="3" rx="2" />
					<line x1="8" x2="16" y1="21" y2="21" />
					<line x1="12" x2="12" y1="17" y2="21" />
				</svg>
				SVG;
	}


	// ----------------MISCELLANEOUS----------------------

	public static function dotsVertical(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M320 208C289.1 208 264 182.9 264 152C264 121.1 289.1 96 320 96C350.9 96 376 121.1 376 152C376 182.9 350.9 208 320 208zM320 432C350.9 432 376 457.1 376 488C376 518.9 350.9 544 320 544C289.1 544 264 518.9 264 488C264 457.1 289.1 432 320 432zM376 320C376 350.9 350.9 376 320 376C289.1 376 264 350.9 264 320C264 289.1 289.1 264 320 264C350.9 264 376 289.1 376 320z"/></svg>
				SVG;
	}
	// ----------------
	public static function language(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M192 64C209.7 64 224 78.3 224 96L224 128L352 128C369.7 128 384 142.3 384 160C384 177.7 369.7 192 352 192L342.4 192L334 215.1C317.6 260.3 292.9 301.6 261.8 337.1C276 345.9 290.8 353.7 306.2 360.6L356.6 383L418.8 243C423.9 231.4 435.4 224 448 224C460.6 224 472.1 231.4 477.2 243L605.2 531C612.4 547.2 605.1 566.1 589 573.2C572.9 580.3 553.9 573.1 546.8 557L526.8 512L369.3 512L349.3 557C342.1 573.2 323.2 580.4 307.1 573.2C291 566 283.7 547.1 290.9 531L330.7 441.5L280.3 419.1C257.3 408.9 235.3 396.7 214.5 382.7C193.2 399.9 169.9 414.9 145 427.4L110.3 444.6C94.5 452.5 75.3 446.1 67.4 430.3C59.5 414.5 65.9 395.3 81.7 387.4L116.2 370.1C132.5 361.9 148 352.4 162.6 341.8C148.8 329.1 135.8 315.4 123.7 300.9L113.6 288.7C102.3 275.1 104.1 254.9 117.7 243.6C131.3 232.3 151.5 234.1 162.8 247.7L173 259.9C184.5 273.8 197.1 286.7 210.4 298.6C237.9 268.2 259.6 232.5 273.9 193.2L274.4 192L64.1 192C46.3 192 32 177.7 32 160C32 142.3 46.3 128 64 128L160 128L160 96C160 78.3 174.3 64 192 64zM448 334.8L397.7 448L498.3 448L448 334.8z"/></svg>
				SVG;
	}
	// ----------------
	public static function cubic(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M348 62.7C330.7 52.7 309.3 52.7 292 62.7L207.8 111.3C190.5 121.3 179.8 139.8 179.8 159.8L179.8 261.7L91.5 312.7C74.2 322.7 63.5 341.2 63.5 361.2L63.5 458.5C63.5 478.5 74.2 497 91.5 507L175.8 555.6C193.1 565.6 214.5 565.6 231.8 555.6L320.1 504.6L408.4 555.6C425.7 565.6 447.1 565.6 464.4 555.6L548.5 507C565.8 497 576.5 478.5 576.5 458.5L576.5 361.2C576.5 341.2 565.8 322.7 548.5 312.7L460.2 261.7L460.2 159.8C460.2 139.8 449.5 121.3 432.2 111.3L348 62.7zM296 356.6L296 463.1L207.7 514.1C206.5 514.8 205.1 515.2 203.7 515.2L203.7 409.9L296 356.6zM527.4 357.2C528.1 358.4 528.5 359.8 528.5 361.2L528.5 458.5C528.5 461.4 527 464 524.5 465.4L440.2 514C439 514.7 437.6 515.1 436.2 515.1L436.2 409.8L527.4 357.2zM412.3 159.8L412.3 261.7L320 315L320 208.5L411.2 155.9C411.9 157.1 412.3 158.5 412.3 159.9z"/></svg>
				SVG;
	}
	// ----------------
	public static function cubicSingle(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M288.3 61.5C308.1 50.1 332.5 50.1 352.3 61.5L528.2 163C548 174.4 560.2 195.6 560.2 218.4L560.2 421.4C560.2 444.3 548 465.4 528.2 476.8L352.3 578.5C332.5 589.9 308.1 589.9 288.3 578.5L112.5 477C92.7 465.6 80.5 444.4 80.5 421.6L80.5 218.6C80.5 195.7 92.7 174.6 112.5 163.2L288.3 61.5zM496.1 421.5L496.1 255.4L352.3 338.4L352.3 504.5L496.1 421.5z"/></svg>
				SVG;
	}
	// ----------------
	public static function layers(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M323.4 112.7L494.8 192L323.4 271.2C321.3 272.2 318.8 272.2 316.7 271.2L145.2 192L316.6 112.7C318.7 111.7 321.2 111.7 323.3 112.7zM343.5 69.2C328.6 62.3 311.4 62.3 296.5 69.2L77.9 170.2C69.4 174.1 64 182.6 64 192C64 201.4 69.4 209.9 77.9 213.8L296.5 314.8C311.4 321.7 328.6 321.7 343.5 314.8L562.1 213.8C570.6 209.9 576 201.4 576 192C576 182.6 570.6 174.1 562.1 170.2L343.5 69.2zM112.1 282.4L77.9 298.2C69.4 302.1 64 310.6 64 320C64 329.4 69.4 337.9 77.9 341.8L296.5 442.8C311.4 449.7 328.6 449.7 343.5 442.8L562.1 341.8C570.6 337.9 576 329.4 576 320C576 310.6 570.6 302.1 562.1 298.2L528 282.4L470.8 308.8L494.9 319.9L323.5 399.1C321.4 400.1 318.9 400.1 316.8 399.1L145.2 320L169.3 308.9L112.1 282.4zM77.9 426.2C69.4 430.1 64 438.6 64 448C64 457.4 69.4 465.9 77.9 469.8L296.5 570.8C311.4 577.7 328.6 577.7 343.5 570.8L562.1 469.8C570.6 465.9 576 457.4 576 448C576 438.6 570.6 430.1 562.1 426.2L528 410.4L470.8 436.8L494.9 447.9L323.5 527.1C321.4 528.1 318.9 528.1 316.8 527.1L145.4 447.9L169.5 436.8L112.3 410.4L78.2 426.2z"/></svg>
				SVG;
	}
	// ----------------
	public static function squarePoll(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M544 160C544 124.7 515.3 96 480 96L160 96C124.7 96 96 124.7 96 160L96 480C96 515.3 124.7 544 160 544L480 544C515.3 544 544 515.3 544 480L544 160zM352 216C352 229.3 341.3 240 328 240L216 240C202.7 240 192 229.3 192 216C192 202.7 202.7 192 216 192L328 192C341.3 192 352 202.7 352 216zM424 296C437.3 296 448 306.7 448 320C448 333.3 437.3 344 424 344L216 344C202.7 344 192 333.3 192 320C192 306.7 202.7 296 216 296L424 296zM288 424C288 437.3 277.3 448 264 448L216 448C202.7 448 192 437.3 192 424C192 410.7 202.7 400 216 400L264 400C277.3 400 288 410.7 288 424z"/></svg>
				SVG;
	}
	// ----------------
	public static function toggleOn(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"$attrString fill="currentColor"><path d="M224 128C118 128 32 214 32 320C32 426 118 512 224 512L416 512C522 512 608 426 608 320C608 214 522 128 416 128L224 128zM416 224C469 224 512 267 512 320C512 373 469 416 416 416C363 416 320 373 320 320C320 267 363 224 416 224z"/></svg>
				SVG;
	}
	// ----------------
	public static function toggleOff(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"$attrString fill="currentColor"><path d="M416 192C486.7 192 544 249.3 544 320C544 390.7 486.7 448 416 448L224 448C153.3 448 96 390.7 96 320C96 249.3 153.3 192 224 192L416 192zM608 320C608 214 522 128 416 128L224 128C118 128 32 214 32 320C32 426 118 512 224 512L416 512C522 512 608 426 608 320zM224 400C268.2 400 304 364.2 304 320C304 275.8 268.2 240 224 240C179.8 240 144 275.8 144 320C144 364.2 179.8 400 224 400z"/></svg>
				SVG;
	}
	// ---------------- BRAND ----------------
	public static function telegramArrow(array $attrs = []): string
	{
		$attrString = self::buildAttributes($attrs);

		return <<<SVG
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" $attrString fill="currentColor"><path d="M541.9 139.5C546.4 127.7 543.6 114.3 534.7 105.4C525.8 96.5 512.4 93.6 500.6 98.2L84.6 258.2C71.9 263 63.7 275.2 64 288.7C64.3 302.2 73.1 314.1 85.9 318.3L262.7 377.2L321.6 554C325.9 566.8 337.7 575.6 351.2 575.9C364.7 576.2 376.9 568 381.8 555.4L541.8 139.4z"/></svg>
				SVG;
	}
	// ----------------


	// ----------------STATIC FIXED METHOD---------------------
	protected static function buildAttributes(array $attrs): string
	{
		return collect($attrs)
			->map(fn($v, $k) => $k . '="' . e($v) . '"')
			->implode(' ');
	}
}

// Usage
/*
	<Button type="button">
		{!! \App\Helpers\IconPack::home(['class' => 'iconPackItem w-5 h-5 text-gray-50']) !!}
	</Button>
*/
