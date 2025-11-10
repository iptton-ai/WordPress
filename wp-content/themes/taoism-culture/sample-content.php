<?php
/**
 * Sample Content Generator
 * 
 * Creates sample culture articles for demonstration
 * 
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Generate Sample Culture Articles
 */
function taoism_generate_sample_articles() {
    $articles = array(
    array(
        'title' => '《道德经》的现代解读',
        'author_title' => '清风道长',
            'excerpt' => '本文深入探讨了《道德经》的核心思想如何在当代社会中为我们提供生活与工作的指引...',
            'content' => '
<p>《道德经》作为道家思想的核心经典，虽成书于两千多年前，但其蕴含的智慧在现代社会依然具有深刻的指导意义。本文将从现代视角重新审视《道德经》中的核心理念，探讨其在当今时代的应用价值。</p>

<h3>无为而治的现代意义</h3>
<p>"无为"并非什么都不做，而是顺应自然规律，不妄为、不强为。在现代管理学中，这一理念与"授权管理"、"情境领导"等理论不谋而合。优秀的管理者懂得因势利导，而非事事亲力亲为。在企业管理中，这意味着建立良好的制度和文化，让团队成员自主发挥，而非过度干预。</p>

<h3>柔弱胜刚强的处世智慧</h3>
<p>《道德经》提出"柔弱胜刚强"的观点，这在现代社会的人际交往和商业竞争中同样适用。以柔克刚，并非懦弱退让，而是一种更高层次的智慧。在谈判中，倾听和理解往往比强硬态度更能达成共识；在竞争中，灵活应变往往比固执己见更容易取得成功。</p>

<h3>知足常乐的幸福观</h3>
<p>在物质丰富但精神焦虑的现代社会，《道德经》所倡导的"知足常乐"显得尤为珍贵。这并不是消极的自我安慰，而是一种积极的生活态度。懂得珍惜已有，不为欲望所困，才能真正获得内心的平静与满足。研究表明，过度的物质追求并不能带来持久的幸福感，反而可能导致焦虑和空虚。</p>

<h3>返璞归真的生活方式</h3>
<p>《道德经》强调"返璞归真"，在当今高度信息化、快节奏的社会中，这一理念提醒我们回归生活的本质。断舍离、极简主义等现代生活方式运动，实际上就是对"返璞归真"思想的当代诠释。减少物欲，简化生活，专注于真正重要的事物，这正是现代人摆脱焦虑、寻找幸福的有效路径。</p>

<h3>结语</h3>
<p>《道德经》的智慧历久弥新，其核心思想在现代社会依然具有强大的生命力。通过现代化的解读和应用，这些古老的智慧可以帮助我们更好地应对当代生活的挑战，找到内心的平衡与和谐。正如老子所言："道可道，非常道"，道的真谛需要在实践中不断体悟和领会。</p>
            ',
            'thumbnail' => 'article-1',
    ),
    array(
        'title' => '道家养生智慧：四季调和',
        'author_title' => '玄通道人',
            'excerpt' => '探讨如何根据春、夏、秋、冬四季的变化，调整饮食、作息与心境，达到天人合一的养生境界...',
            'content' => '
<p>道家养生学强调"天人合一"，认为人体健康与自然四季变化密切相关。本文将从道家传统养生理论出发，结合现代医学知识，探讨如何顺应四季变化进行养生保健。</p>

<h3>春季：生发之时</h3>
<p>春季万物复苏，阳气生发。此时养生重在疏肝理气，舒展筋骨。《黄帝内经》指出："春三月，此谓发陈。"应早睡早起，多到户外活动，接受自然界的生机。饮食宜清淡，多食绿色蔬菜和酸味食物以养肝。情志上要保持心情舒畅，避免过度愤怒，因为"怒伤肝"。</p>

<h3>夏季：生长之时</h3>
<p>夏季阳气旺盛，万物繁茂。养生应注意养心、消暑。适当晚睡早起，但需保证午休。夏季宜清补，多吃苦味食物以清心火，如苦瓜、莲子等。运动宜在清晨或傍晚进行，避免烈日下剧烈活动。保持心境平和，不要过度激动，所谓"心静自然凉"。</p>

<h3>秋季：收敛之时</h3>
<p>秋季天气转凉，万物收敛。此时应注意养肺、防燥。作息要早睡早起，顺应自然界阳气的收敛。饮食上多吃白色和酸性食物，如银耳、梨、葡萄等，以润肺生津。情志调养要"使志安宁"，收敛心神，不要悲秋，因为"忧伤肺"。</p>

<h3>冬季：收藏之时</h3>
<p>冬季寒冷，阳气内藏。养生重在养肾、藏精。应早睡晚起，避免扰动阳气。饮食宜温补，可适当进食羊肉、黑豆等食物。保暖很重要，特别要注意脚部和腰背的保暖。精神上要"无扰乎阳"，保持安静，减少不必要的消耗。</p>

<h3>四季通用养生法则</h3>
<p>无论何季，都应注意：规律作息，适度运动，饮食有节，情志调和。道家养生讲究"清静无为"，避免过度劳累和情绪波动。同时要"法于阴阳，和于术数"，即遵循自然规律，采用适当的养生方法。</p>

<h3>结语</h3>
<p>道家四季养生智慧体现了人与自然和谐共处的理念。顺应四季变化调整生活方式，不仅有益身体健康，更能达到身心和谐、天人合一的境界。这种古老的智慧在现代快节奏生活中更显珍贵，值得我们学习和实践。</p>
            ',
            'thumbnail' => 'article-2',
    ),
    array(
        'title' => '庄子思想中的自由精神',
        'author_title' => '云水散人',
            'excerpt' => '通过解读《逍遥游》等经典篇章，探索庄子哲学中关于个体自由与精神解放的深刻见解...',
            'content' => '
<p>庄子是道家思想的集大成者，其哲学核心在于追求精神的绝对自由。本文将通过解读《庄子》经典篇目，深入探讨这位古代思想家对自由本质的独特理解。</p>

<h3>《逍遥游》：超越物我的境界</h3>
<p>《逍遥游》开篇即以鲲鹏展翅的宏大意象，描绘了一种超越世俗束缚的自由状态。庄子认为，真正的自由不在于外在条件的改变，而在于心灵的解脱。鲲鹏虽大，蜩鸠虽小，各有其适，各得其所。这告诉我们，自由不是比较和竞争，而是找到自己的本性，活出自己的样子。</p>

<h3>齐物论：打破认知的藩篱</h3>
<p>在《齐物论》中，庄子提出了"万物齐一"的观点，挑战了世俗的价值判断。他认为，人们对美丑、善恶、大小、贵贱的分别，都是相对的、人为的。这种思想在现代存在主义哲学中得到了呼应。打破固有的认知框架，才能看到事物的本来面目，获得精神的真正自由。</p>

<h3>养生主：顺应自然的生活艺术</h3>
<p>著名的"庖丁解牛"故事展示了庄子"依乎天理"的思想。庖丁技艺高超，不在于刀的锋利，而在于顺应牛的自然结构。这给我们的启示是：面对复杂的世界，不要强行改变，而要顺势而为。这种顺应自然的态度，是获得自由和从容的关键。</p>

<h3>人间世：在世俗中保持超脱</h3>
<p>庄子并非消极避世，而是主张"虚而待物"。在《人间世》中，他讲述了如何在复杂的社会关系中保持内心的自由。这种"心斋"的境界，要求我们不为外物所役，不为名利所困，保持内心的清明和独立。</p>

<h3>大宗师：生死齐一的超然态度</h3>
<p>庄子对生死有着超然的态度，认为生死不过是气的聚散。这种生死观并非消极，而是一种深刻的生命哲学。当我们能够坦然面对生死，才能真正获得精神的自由，活在当下，珍惜每一刻。</p>

<h3>结语</h3>
<p>庄子的自由思想为我们提供了一个独特的视角，去审视生命的意义和价值。在现代社会，我们常常被各种欲望和焦虑所困，庄子的智慧提醒我们：真正的自由在心，不在外。只有超越物欲的束缚，破除认知的偏见，我们才能达到"逍遥游"的境界，享受生命的自由和美好。</p>
            ',
            'thumbnail' => 'article-3',
    ),
    array(
        'title' => '浅谈内丹修炼法门',
        'author_title' => '紫阳真人',
            'excerpt' => '为初学者介绍内丹修炼的基本概念、步骤与注意事项，引导读者正确认识并入门修行...',
            'content' => '
<p>内丹修炼是道家养生和修行的核心方法之一，历史悠久，体系完整。本文将为初学者介绍内丹修炼的基本概念和入门方法，帮助有兴趣的朋友正确认识这门古老的修行艺术。</p>

<h3>内丹修炼的基本概念</h3>
<p>内丹，是相对于外丹而言的。外丹是指炼制服食的丹药，而内丹则是以人体为鼎炉，以精气神为药物，通过特定的方法在体内炼化，最终达到强身健体、延年益寿的目的。内丹修炼的核心理论是"性命双修"，既注重精神境界的提升（性），也重视身体生命能量的培养（命）。</p>

<h3>修炼的三个基本阶段</h3>
<p>传统内丹修炼分为三个基本阶段：炼精化气、炼气化神、炼神还虚。第一阶段"炼精化气"，主要是通过调息、守窍等方法，将身体的精华之气凝聚起来。这个阶段重在积累能量，培固根基。第二阶段"炼气化神"，是将凝聚的气进一步提升，转化为更精微的能量。这个阶段需要更深的定力和悟性。第三阶段"炼神还虚"，是最高境界，达到与道合一的状态。</p>

<h3>入门的基础功法</h3>
<p>对于初学者，首先应从调息入手。找一个安静的环境，采取舒适的坐姿，闭目静心，调整呼吸。呼吸要自然、细长、深匀，逐渐达到"绵绵若存，用之不勤"的状态。其次是守窍，通常从守丹田开始。将注意力轻轻集中在下丹田（脐下三寸处），但不要太用力，保持"似守非守"的状态。</p>

<h3>修炼中的注意事项</h3>
<p>内丹修炼需要持之以恒，不可急于求成。切忌三天打鱼两天晒网，要建立规律的修炼作息。同时要注意：不可在饱食或空腹时修炼；要选择空气流通、安静的环境；修炼前要放松身心，不带杂念；遇到问题要及时请教明师，不可盲目强练。</p>

<h3>心法比技法更重要</h3>
<p>内丹修炼虽有各种技法，但最根本的是心法。《性命圭旨》云："性者，心也；命者，身也。"修炼不仅是身体的锻炼，更是心性的修养。要保持平和的心态，去除贪嗔痴，培养慈悲喜舍。只有心性纯正，技法才能真正发挥作用。</p>

<h3>现代生活中的应用</h3>
<p>虽然传统内丹修炼要求较高，但其基本原理和方法可以融入现代生活。比如，工作间隙进行几分钟的调息，睡前进行简单的守窍，都能起到放松身心、缓解压力的作用。关键是要持之以恒，将修炼变成生活的一部分。</p>

<h3>结语</h3>
<p>内丹修炼是一门深奥的学问，需要名师指导和长期实践。本文仅为抛砖引玉，希望能帮助初学者建立正确的认识。真正要深入修炼，还需要找到可靠的师承，系统学习。但无论如何，保持身心健康、提升生命质量的初心不变，这也是内丹修炼的根本目的。</p>
            ',
            'thumbnail' => 'article-4',
    ),
    array(
        'title' => '道教艺术中的山水意象',
        'author_title' => '丹青居士',
            'excerpt' => '分析道教绘画作品，解读其中蕴含的山水美学与哲学思想，感受古人的宇宙观与自然情怀...',
            'content' => '
<p>道教艺术与山水的关系源远流长，山水不仅是道教艺术的重要题材，更是道教哲学思想的具象表达。本文将探讨道教艺术中的山水意象所承载的深刻文化内涵。</p>

<h3>山水与道教宇宙观</h3>
<p>在道教思想中，山水是宇宙秩序的缩影。山代表阳刚，水代表阴柔，二者相互依存、相互转化，体现了阴阳和谐的理念。道教绘画中的山水往往不是写实的自然景观，而是艺术家心中理想的天地。这种山水既是现实世界的提炼，也是精神世界的投射。</p>

<h3>仙山楼阁的象征意义</h3>
<p>道教绘画中常见仙山楼阁的描绘，如蓬莱、方丈、瀛洲等。这些仙山往往笼罩在云雾之中，若隐若现，给人以神秘莫测之感。仙山不仅是神仙的居所，更象征着超脱世俗、得道成仙的理想境界。楼阁建筑的描绘体现了"天人合一"的思想，建筑与自然融为一体，人与天地和谐共处。</p>

<h3>云水流动的生命隐喻</h3>
<p>道教艺术特别重视对云和水的描绘。云雾缭绕，变幻莫测，象征着"道"的难以捉摸和无处不在。水的流动不息，"上善若水"，体现了柔弱胜刚强的智慧。许多道教绘画中，云水占据了大量篇幅，通过对云水的精心描绘，表达了生命的流动性和不确定性。</p>

<h3>松柏竹梅的品格象征</h3>
<p>道教山水画中常见松、柏、竹、梅等植物。松柏四季常青，象征长寿和坚韧；竹子虚心有节，代表高洁的品格；梅花傲雪盛开，体现了不畏艰难的精神。这些植物不仅是画面的组成元素，更是道教修行者理想人格的象征。</p>

<h3>留白与"虚实相生"</h3>
<p>道教绘画善用留白，这与道家"虚而待物"的思想密切相关。空白处并非空无，而是充满了想象和可能性。这种"虚实相生"的艺术手法，体现了道家对"无"的深刻理解——"无"不是什么都没有，而是万有之源。</p>

<h3>观照与修行</h3>
<p>对于道教修行者来说，欣赏山水画不仅是审美活动，更是一种修行方式。通过观照画中山水，可以达到澄心静虑、返璞归真的境界。明代画家董其昌说："以蹊径之怪奇论，则画不如山水；以笔墨之精妙论，则山水不如画。"道教山水画超越了自然山水，成为精神世界的载体。</p>

<h3>结语</h3>
<p>道教艺术中的山水意象是道教哲学的视觉化表达。通过对山水画的欣赏和理解，我们可以更深入地体会道家的宇宙观、人生观和美学观。这些古老的艺术作品不仅具有审美价值，更蕴含着深刻的哲学智慧，值得我们细细品味和思考。</p>
            ',
            'thumbnail' => 'article-5',
    ),
    array(
        'title' => '易经与人生哲学初探',
        'author_title' => '守一先生',
            'excerpt' => '介绍《易经》的基本原理，并探讨其六十四卦如何象征人生的不同阶段与境遇，提供决策智慧...',
            'content' => '
<p>《易经》是中华文化的源头活水，被誉为"群经之首"。它不仅是一部占卜之书，更是一部深刻的人生哲学著作。本文将从人生哲学的角度，探讨《易经》的智慧及其现代意义。</p>

<h3>易经的核心思想：变易、简易、不易</h3>
<p>《易经》的"易"有三层含义：变易、简易、不易。变易是指世间万物无时无刻不在变化；简易是指复杂的事物背后有简单的规律；不易是指变化中有不变的原则。这三者构成了《易经》的哲学基础，也为我们理解人生提供了独特视角。</p>

<h3>阴阳之道与人生平衡</h3>
<p>《易经》的基本符号是阴爻(- -)和阳爻(—)，由此构成八卦和六十四卦。阴阳不是对立，而是互补。人生也是如此，成功与失败、快乐与痛苦、得与失，都是生命不可分割的两面。懂得阴阳之道，就是要在人生中寻求平衡，既不过刚，也不过柔。</p>

<h3>乾坤两卦：刚柔并济的智慧</h3>
<p>乾卦象征天，代表刚健；坤卦象征地，代表柔顺。《易经》首卦是乾，第二卦是坤，这体现了刚柔并济的智慧。在人生中，我们既要有"自强不息"的进取精神，也要有"厚德载物"的包容胸怀。只有刚柔相济，才能应对人生的各种挑战。</p>

<h3>六十四卦的人生启示</h3>
<p>《易经》六十四卦象征了人生的各种境遇。比如，"否极泰来"告诉我们困境之后必有转机；"谦受益，满招损"提醒我们要保持谦逊；"大过卦"警示我们不要过度；"渐卦"教导我们循序渐进的重要性。每一卦都蕴含着丰富的人生智慧。</p>

<h3>易经与决策智慧</h3>
<p>《易经》最初是用来占卜的，但其真正价值在于提供决策的思维方式。面对选择时，《易经》教导我们要"审时度势"，根据具体情况做出判断。"时"是时机，"势"是趋势。把握时机，顺应趋势，是成功决策的关键。同时，《易经》强调"君子以思患而预防之"，要有忧患意识，提前做好准备。</p>

<h3>穷则变，变则通，通则久</h3>
<p>这是《易经》中最著名的一句话，揭示了事物发展的规律。当遇到困境时，不要固守成规，而要勇于变革。变革不是盲目改变，而是根据实际情况调整策略。只有适时而变，才能保持持久的发展。这一思想对个人成长和社会发展都有重要启示。</p>

<h3>修身与知命</h3>
<p>孔子说："五十而知天命。"知命不是宿命论，而是认识到人生的规律和限度。《易经》教导我们，在顺应自然规律的基础上，要积极修身，提升自我。"天行健，君子以自强不息"，这是知命与修身的统一。</p>

<h3>结语</h3>
<p>《易经》的智慧博大精深，远不止本文所述。它教导我们以变化的眼光看待世界，以平衡的态度对待人生，以智慧的方式做出决策。在快速变化的现代社会，《易经》的思想依然具有重要的指导意义。让我们从这部古老的经典中汲取智慧，更好地面对人生的挑战和机遇。</p>
            ',
            'thumbnail' => 'article-6',
        ),
        array(
            'title' => '无为而治的管理智慧',
            'author_title' => '虚怀道长',
            'excerpt' => '从《道德经》"无为而治"的理念出发，探讨其在现代企业管理和组织领导中的应用价值...',
            'content' => '
<p>"无为而治"是道家思想的核心理念之一，但常常被误解为消极无为。实际上，"无为"是一种高级的管理智慧，在现代企业管理中具有重要的应用价值。</p>

<h3>无为不是无所作为</h3>
<p>首先要澄清一个误区："无为"并非什么都不做，而是不妄为、不强为、不乱为。《道德经》说："为无为，则无不治。"真正的无为，是按照事物的自然规律去行动，而不是违背规律强行干预。在管理中，这意味着尊重员工的主动性，创造良好的环境和制度，让组织自然地运转。</p>

<h3>建立规则而非事事干预</h3>
<p>优秀的管理者像老子描述的那样："太上，不知有之。"最高明的领导，是让下属感觉不到他的存在，但一切都运转良好。这并不意味着领导不作为，而是他建立了完善的规则和制度，培养了良好的企业文化。在这种环境下，员工知道该做什么，如何做，不需要事事请示。</p>

<h3>授权与信任</h3>
<p>"无为而治"强调授权与信任。管理者要敢于放手，让员工发挥主观能动性。微观管理往往适得其反，不仅束缚了员工的创造力，也消耗了管理者的精力。相反，给予员工足够的信任和空间，他们往往能交出令人满意的答卷。当然，授权不是放任，而是在明确目标和原则的前提下，让员工自主决定执行方式。</p>

<h3>以柔克刚的领导艺术</h3>
<p>《道德经》提出"柔弱胜刚强"，这在领导艺术中体现为以柔克刚、以退为进。强硬的命令和压制可能短期有效，但长期会激起反抗。优秀的领导者懂得倾听、理解、引导，通过柔和的方式影响团队。就像水一样，看似柔弱，却能滴水穿石。</p>

<h3>简化管理流程</h3>
<p>"道法自然"，最好的管理是简单的管理。复杂的流程和繁琐的规定，往往降低效率，增加成本。无为而治的管理智慧提倡简化，去除不必要的环节，让组织更加扁平化、灵活化。现代管理学中的"精益管理"、"敏捷开发"等理念，与此不谋而合。</p>

<h3>培养而非控制</h3>
<p>传统的命令控制型管理正在失效，现代管理更强调培养和赋能。这正是"无为而治"的体现。管理者的角色不是控制者，而是教练和服务者。通过培训、指导、激励，帮助员工成长，提升能力。当员工能力提升了，组织自然就强大了。</p>

<h3>长期主义与耐心</h3>
<p>"无为而治"要求管理者有长期主义的思维和足够的耐心。好的制度和文化不是一朝一夕建成的，需要时间的积累。急功近利、朝令夕改，都违背了"无为"的精神。管理者要有定力，坚持正确的方向，让时间发挥作用。</p>

<h3>结语</h3>
<p>"无为而治"看似简单，实则深刻。它要求管理者有更高的智慧和更广的胸怀。在快速变化的商业环境中，这种管理哲学提醒我们：不要被短期利益迷惑，不要用战术上的勤奋掩盖战略上的懒惰。真正的管理高手，懂得何时发力，何时退后，何时无为。这正是"无为而无不为"的境界。</p>
            ',
            'thumbnail' => 'article-1',
        ),
        array(
            'title' => '道教音乐的疗愈力量',
            'author_title' => '玄音道人',
            'excerpt' => '探讨道教音乐的独特魅力，以及其对身心健康的积极影响，揭示音乐与道的深层联系...',
            'content' => '
<p>道教音乐作为道教文化的重要组成部分，不仅用于宗教仪式，更蕴含着深刻的养生智慧和疗愈功能。本文将探讨道教音乐的特点及其对身心健康的积极作用。</p>

<h3>道教音乐的独特风格</h3>
<p>道教音乐以清雅、幽远、平和为特征，追求"清微澹远"的意境。不同于激昂的进行曲或欢快的流行乐，道教音乐讲究"平和冲淡"，节奏舒缓，旋律悠扬。常用的乐器包括古琴、洞箫、磬、鼓等，这些乐器的音色都具有独特的穿透力和感染力。</p>

<h3>五音与五行的对应</h3>
<p>道教音乐理论认为，音乐的五个基本音（宫、商、角、徵、羽）与五行（土、金、木、火、水）相对应，进而与人体的五脏（脾、肺、肝、心、肾）相关联。不同的音调可以调理不同的脏腑。例如，宫音（do）对应脾，舒缓的宫调音乐可以健脾和胃；角音（mi）对应肝，清新的角调音乐可以疏肝理气。</p>

<h3>音乐与气的关系</h3>
<p>道教认为，音乐是"气"的一种表现形式。悦耳的音乐可以调和人体的气血运行，促进阴阳平衡。在道教的观念中，宇宙万物都是由"气"构成的，音乐作为一种特殊的气的振动，可以直接影响人的身心状态。因此，听道教音乐不仅是听觉的享受，更是一种气的调和过程。</p>

<h3>音乐冥想的实践</h3>
<p>道教音乐常被用于冥想和打坐。在安静的环境中，伴随着古琴的音乐进入冥想状态，可以快速平复心绪，达到"心斋"的境界。现代科学研究也证实，某些频率的音乐可以调节脑波，使人进入放松或专注的状态。道教音乐的频率恰好具有这样的特性。</p>

<h3>疗愈现代人的焦虑</h3>
<p>在快节奏、高压力的现代生活中，许多人饱受焦虑、失眠、抑郁等问题的困扰。道教音乐提供了一种非药物的疗愈方式。研究表明，定期聆听道教音乐可以降低皮质醇水平，减轻压力反应，改善睡眠质量。许多人反馈，在工作间隙听一段道教音乐，能迅速恢复精力，提高工作效率。</p>

<h3>音乐与修行</h3>
<p>对于道教修行者来说，音乐不仅是辅助工具，更是修行的一部分。《道德经》说："大音希声。"最好的音乐接近于无声，但能传达最深刻的含义。通过音乐，修行者可以体悟"道"的境界，达到"天人合一"的状态。因此，道教音乐既是艺术，也是修行，更是哲学。</p>

<h3>如何在日常生活中应用</h3>
<p>普通人也可以将道教音乐融入日常生活。早晨醒来时听一段清新的音乐，可以唤醒身体的能量；工作疲劳时听一段舒缓的音乐，可以缓解压力；睡前听一段平和的音乐，可以帮助入眠。关键是选择适合自己的音乐，并在安静的环境中专心聆听，让音乐的能量真正渗透到身心。</p>

<h3>结语</h3>
<p>道教音乐是中华文化的瑰宝，其疗愈功能在现代社会愈发显示出价值。通过了解和实践道教音乐，我们可以在繁忙的生活中找到一片宁静的天地，滋养身心，提升生命质量。让我们用心聆听，用音乐连接内心的平和与宇宙的和谐。</p>
            ',
            'thumbnail' => 'article-2',
        ),
    );

    $count = 0;
    foreach ($articles as $article) {
        // Check if article already exists
        $existing = get_page_by_title($article['title'], OBJECT, 'culture_article');
        if ($existing) {
            continue;
        }

        // Create the article
    $post_id = wp_insert_post(array(
            'post_title'   => $article['title'],
        'post_content' => $article['content'],
            'post_excerpt' => $article['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'culture_article',
            'post_author'  => 1,
        ));

        if ($post_id && !is_wp_error($post_id)) {
        // Add author title
        update_post_meta($post_id, '_author_title', $article['author_title']);
        
            // Set featured image
            $thumbnail_url = taoism_get_placeholder($article['thumbnail']);
            // Note: In production, you would download and attach the image
            // For now, we'll store the URL in post meta for custom display
            update_post_meta($post_id, '_thumbnail_url', $thumbnail_url);
            
            $count++;
        }
    }

    return $count;
}

/**
 * Generate Sample Products
 */
function taoism_generate_sample_products() {
    if (!class_exists('WooCommerce')) {
        return 0;
    }
    
    $products = array(
        array(
            'name' => '陶瓷茶具套装',
            'name_en' => 'Ceramic Tea Set',
            'price' => 299.00,
            'description' => '精致的陶瓷茶具套装，包括茶壶和茶杯，适合日常品茶使用。',
            'category' => 'tea-sets',
            'image' => 'product-tea',
        ),
        array(
            'name' => '冥想坐垫',
            'name_en' => 'Meditation Cushion',
            'price' => 399.00,
            'description' => '舒适的冥想坐垫，采用天然材料制作，帮助您保持正确的冥想姿势。',
            'category' => 'ritual-implements',
            'image' => 'product-cushion',
        ),
        array(
            'name' => '书法卷轴',
            'name_en' => 'Calligraphic Scroll',
            'price' => 799.00,
            'description' => '传统书法卷轴，由名家书写，适合挂在书房或客厅。',
            'category' => 'calligraphy-art',
            'image' => 'product-scroll',
        ),
        array(
            'name' => '天然檀香',
            'name_en' => 'Natural Incense',
            'price' => 99.00,
            'description' => '天然檀香，香气怡人，适合冥想和放松使用。',
            'category' => 'incense-aromatics',
            'image' => 'product-incense',
        ),
        array(
            'name' => '紫砂香炉',
            'name_en' => 'Purple Clay Incense Burner',
            'price' => 599.00,
            'description' => '手工制作的紫砂香炉，具有独特的倒流香效果。',
            'category' => 'incense-aromatics',
            'image' => 'product-tea',
        ),
        array(
            'name' => '道德经珍藏版',
            'name_en' => 'Tao Te Ching Collector Edition',
            'price' => 199.00,
            'description' => '精装版《道德经》，配有详细注释和解读。',
            'category' => 'books-scriptures',
            'image' => 'product-scroll',
        ),
    );

    $count = 0;
    foreach ($products as $item) {
        // Check if product already exists
        $existing = get_page_by_title($item['name'], OBJECT, 'product');
        if ($existing) {
            continue;
        }

        // Create product
        $product = new WC_Product_Simple();
        $product->set_name($item['name']);
        $product->set_slug(sanitize_title($item['name_en']));
        $product->set_regular_price($item['price']);
        $product->set_description($item['description']);
        $product->set_short_description($item['description']);
        $product->set_status('publish');
        $product->set_catalog_visibility('visible');
        $product->set_stock_status('instock');
        
        $product_id = $product->save();
        
        if ($product_id) {
            // Set product category
            $category_term = get_term_by('slug', $item['category'], 'product_cat');
            if ($category_term) {
                wp_set_object_terms($product_id, $category_term->term_id, 'product_cat');
            }

            // Store image URL for custom display
            update_post_meta($product_id, '_thumbnail_url', taoism_get_placeholder($item['image']));
            
            $count++;
        }
    }

    return $count;
}

// Add admin menu item to generate sample content
add_action('admin_menu', function() {
    // Add under Culture Articles menu
    add_submenu_page(
        'edit.php?post_type=culture_article',
        __('Generate Sample Content', 'taoism-culture'),
        __('Generate Samples', 'taoism-culture'),
        'manage_options',
        'generate-sample-content',
        'taoism_render_sample_content_page'
    );
    
    // Also add under Tools menu for easier access
    add_management_page(
        __('Generate Sample Content', 'taoism-culture'),
        __('Generate Samples', 'taoism-culture'),
        'manage_options',
        'generate-sample-content-tools',
        'taoism_render_sample_content_page'
    );
});

/**
 * Create essential pages
 */
function taoism_create_essential_pages() {
    $pages = array(
        'culture' => array(
            'title' => 'Culture',
            'content' => '<p>Explore our collection of articles about Taoist culture, philosophy, and practices.</p>',
        ),
        'community' => array(
            'title' => 'Community',
            'content' => '<p>Join our community forum to discuss Taoist philosophy, share experiences, and connect with like-minded individuals.</p>',
        ),
        'about' => array(
            'title' => 'About Us',
            'content' => '<h2>About Tao Cultural Center</h2><p>Welcome to our cultural center dedicated to preserving and sharing the wisdom of Taoism.</p>',
        ),
    );
    
    $created = 0;
    foreach ($pages as $slug => $page_data) {
        // Check if page exists
        $existing_page = get_page_by_path($slug);
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_name' => $slug,
                'post_content' => $page_data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ));
            if ($page_id) {
                $created++;
            }
        }
    }
    
    return $created;
}

/**
 * Render the sample content generation page
 */
function taoism_render_sample_content_page() {
            $articles_generated = 0;
            $products_generated = 0;
            $pages_created = 0;
            
            if (isset($_POST['generate_articles']) && check_admin_referer('generate_samples_nonce')) {
                $articles_generated = taoism_generate_sample_articles();
            }
            
            if (isset($_POST['generate_products']) && check_admin_referer('generate_samples_nonce')) {
                $products_generated = taoism_generate_sample_products();
            }
            
            if (isset($_POST['create_pages']) && check_admin_referer('generate_samples_nonce')) {
                $pages_created = taoism_create_essential_pages();
            }
            
            if ($articles_generated > 0) {
                echo '<div class="notice notice-success"><p>' . sprintf(__('%d sample articles have been generated.', 'taoism-culture'), $articles_generated) . '</p></div>';
            }
            
            if ($products_generated > 0) {
                echo '<div class="notice notice-success"><p>' . sprintf(__('%d sample products have been generated.', 'taoism-culture'), $products_generated) . '</p></div>';
            }
            
            if ($pages_created > 0) {
                echo '<div class="notice notice-success"><p>' . sprintf(__('%d essential pages have been created.', 'taoism-culture'), $pages_created) . '</p></div>';
            } elseif (isset($_POST['create_pages'])) {
                echo '<div class="notice notice-info"><p>' . __('All pages already exist.', 'taoism-culture') . '</p></div>';
            }
            ?>
            <div class="wrap">
                <h1><?php esc_html_e('Generate Sample Content', 'taoism-culture'); ?></h1>
                
                <h2><?php esc_html_e('Essential Pages', 'taoism-culture'); ?></h2>
                <p><?php esc_html_e('Create essential pages (Culture, Community, About Us) if they don\'t exist.', 'taoism-culture'); ?></p>
                <form method="post" style="margin-bottom: 30px;">
                    <?php wp_nonce_field('generate_samples_nonce'); ?>
                    <button type="submit" name="create_pages" class="button button-primary">
                        <?php esc_html_e('Create Essential Pages', 'taoism-culture'); ?>
                    </button>
                </form>
                
                <hr style="margin: 30px 0;">
                
                <h2><?php esc_html_e('Sample Articles', 'taoism-culture'); ?></h2>
                <p><?php esc_html_e('This will create 8 sample culture articles for demonstration purposes.', 'taoism-culture'); ?></p>
                <form method="post" style="margin-bottom: 30px;">
                    <?php wp_nonce_field('generate_samples_nonce'); ?>
                    <button type="submit" name="generate_articles" class="button button-primary">
                        <?php esc_html_e('Generate Sample Articles', 'taoism-culture'); ?>
                    </button>
                </form>
                
                <h2><?php esc_html_e('Sample Products', 'taoism-culture'); ?></h2>
                <p><?php esc_html_e('This will create 6 sample products for demonstration purposes.', 'taoism-culture'); ?></p>
                <form method="post">
                    <?php wp_nonce_field('generate_samples_nonce'); ?>
                    <button type="submit" name="generate_products" class="button button-primary">
                        <?php esc_html_e('Generate Sample Products', 'taoism-culture'); ?>
                    </button>
                </form>
            </div>
            <?php
}
