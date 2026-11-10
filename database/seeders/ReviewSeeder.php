<?php

namespace Database\Seeders;

use App\Models\Reviews\Review;
use App\Models\System\Settings\OptionEnv;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
		$reviews = [
			// user 1 → both courses
			['tier_id'=>1,'course_id'=>1,'user_id'=>1,'message'=>'This course provides a very solid and practical foundation for learners who want to move beyond basic understanding. The lessons are structured in a progressive way, allowing concepts to build naturally without overwhelming the learner. I particularly liked how real-world examples were used throughout the modules, making it easier to connect theory with actual usage. The exercises are well designed and reinforce the learning effectively, making it a highly valuable experience overall.','rating'=>5,'status'=>1],
			['tier_id'=>2,'course_id'=>2,'user_id'=>1,'message'=>'A well-designed course that focuses on deeper understanding and application of advanced concepts. The pacing is balanced and each section flows logically into the next, helping maintain engagement throughout. The explanations are clear, and the content challenges you just enough to encourage growth without being frustrating. By the end, I felt much more confident applying what I learned in practical scenarios, which is exactly what I was looking for.','rating'=>4,'status'=>1],

			// user 2 → only course 1
			['tier_id'=>1,'course_id'=>1,'user_id'=>2,'message'=>'This course helped me build a strong foundation and significantly improve my understanding. While some parts required extra attention, the overall structure made it manageable and engaging. The examples were practical and relevant, which made it easier to retain information. I appreciated the effort put into making the lessons clear and applicable to real-life situations, making it a worthwhile learning experience.','rating'=>4,'status'=>1],

			// user 5 → both courses
			['tier_id'=>1,'course_id'=>1,'user_id'=>5,'message'=>'An excellent course that combines clarity, structure, and practical insight. The instructor has done a great job breaking down complex topics into simple and understandable parts. Each module feels purposeful, and the progression keeps you motivated. The real-world examples and exercises are particularly helpful, as they reinforce learning in a meaningful way. Overall, this course exceeded my expectations and provided great value.','rating'=>5,'status'=>1],
			['tier_id'=>2,'course_id'=>2,'user_id'=>5,'message'=>'This course goes deeper into advanced concepts and presents them in a way that is both challenging and rewarding. It encourages critical thinking and pushes you to apply knowledge rather than just memorize it. The structure is well thought out, and the content remains engaging throughout. Completing this course gave me a noticeable boost in confidence and understanding, making it a highly beneficial experience.','rating'=>5,'status'=>1],

			// user 6 → only course 2
			['tier_id'=>2,'course_id'=>2,'user_id'=>6,'message'=>'A challenging yet highly rewarding course that demands focus and consistency. The depth of content is impressive, and the explanations are clear enough to guide you through even the more complex sections. It is not a passive learning experience, but that is what makes it valuable. By the end of the course, I felt a significant improvement in both my understanding and ability to apply the concepts effectively.','rating'=>4,'status'=>1],
		];

      foreach ($reviews as $review) {
         Review::updateOrCreate(
            ['tier_id' => $review['tier_id'], 'course_id' => $review['course_id'], 'user_id' => $review['user_id']],
            ['message' => $review['message'], 'rating' => $review['rating'], 'status' => $review['status']]
         );
      }
   }
}
