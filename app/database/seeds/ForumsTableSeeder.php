<?php

class ForumsTableSeeder extends Seeder
{
    public function run()
    {
        $forumGroup = [
            [
                'title'         => 'Guildet',
                'author_id'     => 1
            ],
            [
                'title'         =>  'Raid',
                'author_id'     =>  1
            ],
            [
                'title'         =>  'Hemsidan',
                'author_id'     =>  1
            ],
            [
                'title'         => 'Officer Forum',
                'author_id'     => 1
            ]
        ];

        $forumCategory = [
            [

            'title'         =>     'Tavernan',
            'subtitle'      =>     'Skitsnack och ljugarbänk',
            'author_id'     =>      1,
            'group_id'      =>      1

        ],
            [

            'title'         =>     'Diskussioner',
            'subtitle'      =>     'Diskutera allt som rör guildet',
            'author_id'     =>      1,
            'group_id'      =>      1

        ],
        [

            'title'         =>     'Guild Bank',
            'subtitle'      =>      'Allt som rör Guild Banken',
            'author_id'     =>      1,
            'group_id'      =>      1

        ],
        [

            'title'         =>     'Viktig Guild Informatin',
            'subtitle'      =>      'Viktiga nyheter och uppdateringar',
            'author_id'     =>      1,
            'group_id'      =>      1

        ],
        [

            'title'         =>     'Raids',
            'subtitle'      =>      'Våra raids',
            'author_id'     =>      1,
            'group_id'      =>      2

        ],
        [

            'title'         =>     'Raid Taktiker',
            'subtitle'      =>      'Diskutera taktiker här',
            'author_id'     =>      1,
            'group_id'      =>      2

        ],
        [

            'title'         =>     'Raid Diskussion',
            'subtitle'      =>      'Allt annat som rör raids',
            'author_id'     =>      1,
            'group_id'      =>      2

        ],
        [

            'title'         =>     'Feedback och Idéer',
            'subtitle'      =>      'Har du en bra idé, släpp loss dina tankar här',
            'author_id'     =>      1,
            'group_id'      =>      3

        ],
        [

            'title'         =>     'Buggar och Skräp',
            'subtitle'      =>     'Rapportera buggar här',
            'author_id'     =>      1,
            'group_id'      =>      3

        ]
        ];

        $forumThreads = [
            [
                'title'         =>      'Irl pics!',
                'body'          =>      'Lite beskrivande text här som visar att detta är en trådinnehåll!',
                'group_id'      =>      1,
                'author_id'     =>      1,
                'category_id'   =>      1,
            ],
            [
                'title'         =>      'Säljer en massa guld för de som needar',
                'body'          =>      'Lite beskrivande text här som visar att detta är en trådinnehåll!',
                'group_id'      =>      1,
                'author_id'     =>      1,
                'category_id'   =>      1,
            ],
                [
                'title'         =>      'Vad gör folk?',
                'body'          =>      'Lite beskrivande text här som visar att detta är en trådinnehåll!',
                'group_id'      =>      1,
                'author_id'     =>      1,
                'category_id'   =>      1,
            ]
        ];

        foreach($forumGroup as $group)
        {
           ForumGroup::create($group);

        }
        foreach($forumCategory as $category)
        {
            ForumCategory::create($category);
        }

        foreach($forumThreads as $thread)
        {
            ForumThread::create($thread);
        }
    }
}