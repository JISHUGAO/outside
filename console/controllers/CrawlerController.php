<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14 0014
 * Time: 10:46
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\models\Article;

class CrawlerController extends Controller
{
    public function actionArticle()
    {
        Article::startCrawl();
       /* $content = <<<HTML
 <p style="text-align: center; text-indent:0;"><a href="http://www.cankaoxiaoxi.com/" target="_self"><img src="http://upload.cankaoxiaoxi.com/2016/1214/1481693384143.jpg"></a></p>
<p style="text-align: center;font-size:12px;line-height:12px; padding-bottom:0; margin-top:-10px;"><a href="http://www.cankaoxiaoxi.com/" target="_self" style="color:#f00">点击图片进入下一页</a></p>
<p style="text-align: center;"><span style="font-size: 12px;">“东京书与床”店内一角（摄影 杨汀）</span></p>
<p><strong>《参考消息》12月14日报道</strong> 日本人爱读书看报和实体书店发达常常被当作美谈，但近年来随着互联网和电子书的兴起，日本的出版业和实体书店也受到很大冲击。在这种情况下，日本出版界和实体书店开始致力于探索书店的新模式，“旅馆书店”、“只销售一本书的书店”等书店形式令人耳目一新，策划书店旅行、与便利店联营等经营形式也应运而生。</p>
<p><strong>可以住宿的书店</strong></p>
<p>在东京的繁华商业区池袋地区的火车站附近，一家近来日本最火的书店“东京书与床”栖居在一栋普通写字楼的七层。这里的书架陈列出约1700本书，每月更换其中的一部分；提供30个床位，有的在书架之中，有的像储物格一样集中排列在一起；此外还有沙发、咖啡角、淋浴间、厕所等公共设施。确切地说，它更像一家“图书主题的旅馆”，因为这里并不卖书。</p>
<p>“东京书与床”由东京的一家地产中介公司开发，主打“可以随意翻阅喜欢的书，困了就躺下睡”的阅读和休闲体验。投宿者还可以互相沟通或者与店员交流阅读感受。入住和退房时间是16点和次日11点，两种床位的住宿费计入消费税分别为4104日元（100日元约合6元人民币）和5184日元。另外，每天13点到17点供不住宿的来访者使用，1小时540日元，1560日元可以停留4小时。</p>
<p>店内播放着柔美的轻音乐，灯始终不熄，但随着夜色渐深逐渐调暗灯光。“比一般书店更有尽情阅读的感觉，比图书馆少一点拘谨，又比漫画咖啡店舒服，而且没有分隔，可以与人交流。”家住东京都内，为体验而来的40多岁公司职员大河内说。</p>
<p>店内图书以休闲读物为主，涵盖小说、随笔、漫画、写真集，也有商务书和社会学、哲学类著作，其中一部分不是市面常见的。外文书占到20%，也有少量中文书籍。据工作人员介绍，他们还向社会“募书”，一些投宿者或来访者还会把自己的书留下，书店经过选择后进行陈列。</p>
<p>据“东京书与床”工作人员介绍，来访者中20多岁和30多岁的年轻人占到90%，很多是从社交媒体上获悉，慕名前来的。今年11月是书店开业一周年，据说入住率一直保持着近100%；书店在海外也获得了很高评价，英国的《独立报》和《卫报》以及很多时尚杂志都对其进行了报道。12月2日，位于京都祇园的第二家店也开张迎客。</p>
<p><strong>“只卖一本书”的书店</strong></p>
<p>与“东京书与床”提供让人置身于书屋、随意选择的体验相反，位于银座的森冈书店则只出售一本书，以“一室一册”、“别无他选择”为卖点。不到17平方米的空间内装修极简，每周二换上一本新书，以设计和创意类书籍为主，从几百日元到几千日元不等。室内布置则结合每本书的主题和特点进行相应变换，同时举办相关展览和交流活动，还常常会邀请作者参与其中。</p>
<p>41岁的店主森冈督行曾在东京著名的二手书店任职8年，之后又自己创办和经营二手书店10年。他坦言，随着网络和电子书的盛行，实体书店的经营越来越难。同时，他发现，很多人进书店并没有明确目标，多半是随便挑拣，能否遇到好书取决于运气。于是他产生了替读者作出选择的想法，“又回忆起在二手书店举办出版纪念会、读者交流会时，作者和读者交流时双方幸福的神情”，他决定“只卖一本经过选择的书，创造作者与真正对这本书感兴趣的读者交流的机会”。</p>
<p>随着知名度不断提升，越来越多的国内外读者、游客前来买书或参观，还有不少作家和出版商来寻求合作。目前森冈书店每周售书多则250多本，少则十几本。举办新书出版纪念会、发售纪念会、签售活动以及相关展览等也成为书店的盈利手段。</p>
<p><strong>让读者与书“相遇”</strong></p>
<p>除了一些独立书店在探索书店的形式，老牌连锁书店也在通过策划别出心裁的活动来招揽读者。</p>
<p>如淳久堂书店位于东京的几家分店就在开展为期两天的“书店之旅”，一次征集5组、10名参加者，只需购买最少一本书或杂志，就可以免费在淳久堂通宵达旦自由阅读，书店还提供睡袋、充气床垫和躺椅，参加者可以随意“打地铺”，在店内吃东西也被允许。该活动人气爆棚，由于报名者太多，需要通过抽签来决定参加者，据说霞关分店的中签率达到1/900。</p>
<p>明屋书店则对位于城市郊区的部分连锁店进行改装，腾出一半空间租给“7-11”便利店。据说与便利店联营以后，图书的销售额仍保持了改装前的水平。以出产优质大米和蔬菜著名的农业大县秋田的一些书店还结合当地特色，在书店一角销售起农产品。</p>
<p>淳久堂“书店之旅”的策划者表示：“（现在）对书店而言是一个严峻的时代，但还是希望读者重新认识到书店的有趣。”</p>
<p>据《朝日新闻》援引的最新数据，2016年日本全国的书店数量下降到13041家，比2000年减少了约60%；2015年书籍和杂志的出版销售额约为15220亿日元，不到顶峰时期1996年的60%。</p>
<p>日本书籍出版协会专务理事中町英树表示，实体书店门庭冷清、书卖不出去有多方面的原因。“互联网和社交媒体的盛行导致杂志销量下降，娱乐信息泛滥占据了人们的很多时间。就日本而言，图书馆的服务越来越充实便利也是一个原因。”淳久堂难波店的店长、著有《书店与民主主义》一书的福岛聪则认为，近年日本社会充满闭塞感，对书店业界也投下了阴影。“很多人对未来不安，抱着急功近利或者及时行乐的心态，所以对于不是马上有回报的读书就敬而远之了”。对于独立书店的创新以及一些联营形式，某大出版社的高层表示，话题性创新虽然能吸引一些读者，但其可持续性有待验证，也不可否认，与便利店的联营等仍是实体书店机能萎缩的表现。</p>
<p>“实体书店不会死亡。如何创造读者与书店、书的多种多样的‘相遇’，是我们的课题。”东京著名的二手书市神保町书市的负责人大桥信夫说。森冈书店的店主森冈督行也表示：“纸版书要生存下去，交流非常重要。”</p> 
HTML;

        Article::extractCoverPicture($content);*/
    }
}