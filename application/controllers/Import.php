<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	function index()
	{
		$this->load->model("Names_model");
		$myfile = fopen(base_url( "names.txt"), "r") or die("Unable to open file!");
		$string = fread($myfile,filesize("names.txt"));

		$a1 = Strings::parse($string,"\n");

		$this->Names_model->dropAll();
		for($i=1 ; $i<=$a1['total'] ; $i++){
			$a2 = Strings::parse($a1[$i],",");
			$repeated = $this->Names_model->insert($a2[2],$a2[1]);
			if($repeated) echo "<br>Repeating: ".$a1[$i];
		}

		$i--;
		echo "<br><br>-----------------------------<br>Total Added: ".$i;
		fclose($myfile);
	}

    public function salam()
    {
        echo 'salam';
    }

	public function newn()
	{
		$this->load->model("Names_model");
		$number = '100
101
102
103
104
105
106
107
108
109
110
111
112
113
114
115
116
117
118
119
120
121
122
123
124
125
126
127
128
129
130
131
132
133
134
135
136
137
138
139
140
141
142
143
144
145
146
147
148
149
150
151
152
153
154
155
156
157
158
159
160
161
162
163
164
165
166
167
168
169
170
171
172
173
174
175
176
177
178
179
180
181
182
183
184
185
186
187
188
189
190
191
192
193
194
195
196
197
198
199
200
201
202
203
204
205
206
207
208
209
210
211
212
213
214
215
216
217
218
219
220
221
222
223
224
225
226
227
228
229
230
231
232
233
234
235
236
237
238
239
240
241
242
243
244
245
246
247
248
249
250
251
252
253
254
255
256
257
258
259
260
261
262
263
264
265
266
267
268
269
270
271
272
273
274
275
276
277
278
279
280
281
282
283
284
285
286
287
288
289
290
291
292
293
294
295
296
297
298
299
300
301
302
303
304
305
306
307
308
309
310
311
312
313
314
315
316
317
318
319
320
321
322
323
324
325
326
327
328
329
330
331
332
333
334
335
336
337
338
339
340
341
342
343
344
345
346
347
348
349
350
351
352
353
354
355
356
357
358
359
360
361
362
363
364
365
366
367
368
369
370
371
372
373
374
375
376
377
378
379
380
381
382
383
384
385
386
387
388
389
390
391
392
393
394
395
396
397
398
399
400
401
402
403
404
405
406
407
408
409
410
411
412
413
414
415
416
417
418
419
420
421
422
423
424
425
426
427
428
429
430
431
432
433
434
435
436
437
438
439
440
441
442
443
444
445
446
447
448
449
450
451
452
453
454
455
456
457
458
459
460
461
462
463
464
465
466
467
468
469
470
471
472
473
474
475
476
477
478
479
480
481
482
483
484
485
486
487
488
489
490
491
492
493
494
495
496
497
498
499
500
501
502
503
504
505
506
507
508
509
510
511
512
513
514
515
516
517
518
519
520
521
522
523
524
525
526
527
528
529
530
531
532
533
534
535
536
537
538
539
540
541
542
543
544
545
546
547
548
549
550
551
552
553
554
555
556
557
558
559
560
561
562
563
564
565
566
567
568
569
570
571
572
573
574
575
576
577
578';

		$name = 'فاطمه دادخواه
رضا حق جو
سعید نجفی
احمد اکبری
اقدس چوبدار
اسماعیل فرجی
حسین فشکی فراهانی
نام زنده یاد ثبت نشده است
رضا آذرهوش قاضی محله
تارا مستر
حسین کلیایی
زهرا ملکی
رشید نوروزهی
نام زنده یاد ثبت نشده است
فرناز آهنگران
لیلا پیغمبرزاده
عباسعلی حق نیا
مجید مقدس نژاد
نام زنده یاد ثبت نشده است
گلجهان نعمتی
مهیا مطیعی حقیقی
نام زنده یاد ثبت نشده است
میلاد کربلایی طوس
هانی دلشاد
محمدصادق شوشتری
نام زنده یاد ثبت نشده است
محمد حاج علی نوروزی
مرضیه کمال آبادی
نام زنده یاد ثبت نشده است
صبا زارعی
رباب حبیبی
نام زنده یاد ثبت نشده است
مهرناز کلاته اقا محمدی
نام زنده یاد ثبت نشده است
میلاد برزآبادی فراهانی
عرفان کوچولو
نام زنده یاد ثبت نشده است
مهران محرابی
براتعلی عیوض خانی
نام زنده یاد ثبت نشده است
امید شاهسوار
مهدی قبادزاده
مهدی کاظمی فرد
مهدیه آدینه
معصومه مطلب
اقبال خزایی
اکبر ایزدی
رسول احمدی
اسماعیل لطفی
اسماعیل مرادی
سید تیمور جلالی
زهرا صارمی
عباس محبی آشتیانی
رمضان علی ناوشکن
ثریا غفاری
فرشید عابدی
غلامرضا فخاری
عزی عابد محزون پسند
فردوس بحیرایی
بهاره قطاری
نیره سادات عظیمی نژاد
شهربانو خصالی
حسین فرهمندنیا
حامد عبادی
حلیمه جعفری
حمید حقانی
حسین پرویزی راد
پیمان احمدی
امیرحسین پورعلی
صالحی ارمکی
ابراهیم قربانی
لیلا صمدی
مدد سیابی کلخوران
رضا غنی آبادی
نورشرف جلالی اقدم
محمد نادری
مهدی محمدی نودهی
محمد اسدی
فریبا مصاعی 
شاپور نریمانی گیلانی
سید حمید صنایع
مریم سمیه ئی 
محمود کردعلی
هودا هاشمی
محدثه حلبی فلاح
لطف الله تاجر قلعه سین
شیرین هما ترک زبان
صابر صفری
نام زنده یاد ثبت نشده است
رضا شیرازی
زهرا مقصودی
زینب نوری
رضا ابوالقاسمی
مهدی استیری
مجتبی عطایی
محمد رسولی
ایرج دارور
محمد چرمی
مهران امانی
محمد مقدم امیر شکاری
همایون عموکیان
آرمین دوستی
ابوالفضل حسینی
اصغر اکرادی
امیرمهدی یاقوتی فرید
علیرضا اسدی نیا
علی اکبر گندمی
کیوان چزانی شراهی
محمد کاظم پور
مسعود صادقی
محمد حسین قربی
منصور دانشور
مهدی ابراهیم زاده
مژگان کربلایی عبدالمحمد
حسین آقا کریمی
ابوالفضل محمدی زاده
مازیار پورسرتیپ
فرهاد خویشوند
حامد ارژنگی
حسین محصوری مهربانی
حسن راستگو
حسن رحیمی اردکانی
نسرین تاجیکی
معصومه خان محمدی
نجمه عرب زاده
ایمان کلانتری
امیر داد صفایی
علی اکبر امام قلی
فاطمه ابراهیمی
محمود قدرتی
نام اهدا کننده ثبت نشده
روح الله تاجیک
نام اهدا کننده ثبت نشده
نام اهدا کننده ثبت نشده
محمدعلی احمدی علی اباد
بهنام فراش باشی
بهاره دولت آبادی
علی شبگیر
نام اهدا کننده ثبت نشده
صفورا نوری
سمیه استیری
اشکان مهربان
احمد ایروانی
محمدمهدی کفاشی
محمد حسین آبکار
جعفر محبی پردستی
مهران مختاری
شهرام محب حسینی
بهاره سالمی
پروین کربلایی محمد میگونی
حسین آتش پنجه
علی علیخانی
جمال نظامی زاد
عفت ایرانشاهی
علی بهرامی
سعید جعفرزاده
ابوالفضل بلوچی
ایمان جورابلو
حامد گلبهاری
حمید بابالویی
رستگار رحیمی
زیبا غیاثوند ملایری
صفر رستمی
شیوا پورحسین
ابوالفضل کرمی
امیرحسین حیدری
نسرین امیرجوادی
هستی فشکی
میثم مجیدی
نویدرضا انوری
مینا فراهانی
علی اکبری
محمدرضا قربانی
علی خاکسار
غلامرضا بیگدلی
صدیقه اصغری
سعید بایرام زاده
سمیه صادقی
رامین ملایی
سجاد حموله
سارا یاغموری
سارا یاغموری
حمیدرضا قربانعلی فرد
حسین صانعی
اسماعیل ممانی
المیرا صفاخواه
احسان عزتی
مهران هادی لو
جواد نوربخش
نیما لطفی
نبی الله امینی
محمد عباس آبادی
لیلا علیه پور
فریدالدین فیروز بخت
محمد یار محمدی
محمد عابدی
صالح ملایی
شهناز کدخدازاده
بخشعلی شهبازی
حمیدرضا غفاری نیک
دانیال عرب
محمد دزبون
حسین روح افزا
حبیب الله توکلی
محمد سلیمیان
محمدرضا عباسی
قربانعلی اکبر آبادی
مهدی کریمی
ناصر پلنگ پور
سید رسول میرهاشمی
غلامرضا دلیر مشهدی
رضا سیاحی
رضا کوهی
امیرسام حسین زاده
عباس غیبعلی مجد آبادی
عادل صدف زاده
فاطمه نقی بیگلو
زینب موسوی
اسماعیل رشیدی پیش آهنگ
امیرحسین عنبرستانی
شاپوری
فاطمه رشوند
علی خاطری
سعید احمدی
محسن خسرو شنگل آبادی
فریده ولی
گل اوغلان سبزی یسار
محمدابراهیم ایرانمنش
مسیب کریمی
مهری اسماعیلی
نام زنده یاد ثبت نشده است
نام زنده یاد ثبت نشده است
نام زنده یاد ثبت نشده است
نام زنده یاد ثبت نشده است
عارفه باقری
زینب طلوع کلان
سعید شاه نظرخان
جلیل خلیلی
جعفر امین آبادی
حامد بابایی
حسن شهبازی
کبرا مینوچهر
مریم وجدانی
ساناز فطرتی
بهروز قشلاقی
فاطمه ایوبی
علی ده منش
فاطمه ابراهیمی نیا
امیرحسین جوادی
اسدالله وحدت درو
آرمین دستجردی
رسول خوش روزگار
ژاله احمدیان
ژیلا صادقی
احمد معصومی گرگانی
الهام سمسارزاده
میثم پیرهادی
کمال امی
غلامرضا شریفی پور
غلامرضا محمودی
علی خزایی
سورا بیات
سعید باباگل زاده
فیروز هوشیار
محمدرضا صاحب جمعی
مهدی مردانی
مروژ صفری
مهناز سلمانی ها
زینب بهرامخانی
زهرا شهنوازی آزاد
زینب علی پور
کیوان یاقوتی
محمد رضایی
مجید حسینی
فاطمه جلینی
علی نام آور
هادی مرادی
محمدحسین فلاح
صبا کاربر
سید احمد طباطبایی
سید علی موسوی
شهناز مجیدیان
زهرا رجب فرخانی
زرین تاج اسمعیلی
رحمت الله ابوالقاسمی
حمیدرضا مزرعه فراهانی
حسام عسگری
خسرو غلام نژاد
حسین اکبری
امیرعلی محمدی پردستی
امیر بهرامی
مصطفی اکبری 
مهدی جاهد
نادر حسنی
مهدی رودکی
مجید گودرزی
محمدمتین منصوری
اسماعیل سلطانی
ابوالقاسم بدری بهنو
زهرا جمالی
داود مداح
عباس ده خدم
سیدعباس  طباطبایی مرادی
آزاده بیرالوند
پدرام ایمان علیزاده
جاسم مهدوی
اکرم ملارضایی
ناصر خلیفه
مهدی هاشمی
مهدی مهدی زاده
فاطمه عاجلو
محمد غلامی نیاری
محمد شصتی
وحید عرب عامری
شکوفه مرادیان سرا شهرک
سیدعلی حسینی
محمدرضا کریمی
عارف زاد جمال سیفی
طاهره رحیمی
علی عربی لنگه
فاطمه خماری
محمد اسماعیل کشاورز افشار
محمد اردبیلی
نوید علوی
نورالله پور رییسی
عطیه قلی زاده
مهدی صادق نژاد
زهرا رسولی
حمزه علی نجف پور
خلیل مجتهدی
خدیجه مشهدی
پروین شیرمحمدی
پروانه فیروزبخش
پروین غنیمتی
الناز طاهری
جمیله بزرگر
ذبیح الله فلاحی
رهام سمیع پور
محمدحسین شفیعی
سجاد باهنر
محمدحسن فاطمی
میرداود موسوی
مرتضی رسولی
محمدهادی نصیری مهر
مهدی میرزایی زینالی
نوروز سلیمان پور
سیدولی حسینی
طاهره منصوری مقدم
صدرالله توکلی
سحر خسروی
محمد حسین ریخته گران
عباس بنده یزدانی
فاطمه فلاحتکار
فاطمه حیدری
مائده عربی
محیا شاه آبادی
محمد علیوند
مهدی محمود آبادی
مسعود رمضانی
نوید زمانی
سجاد عظیمی
نادر کردی
احمد سلمی زاده
پروانه چای پز آهندانی
الهام تربتی
ربابه طبسی
آرزو آذری
پیمان رستم زاده
امیرحسن غلامی نوری
اکرم ناطقی
اکرم عبادی
حمید مشهدی حسین
محسن بنده ئی
حسن بخان
رضا امیری
زینب خوبستانی
حسین تشکری
حاجعلی صحبتی
آزاده رحیمی
رضا سیسان
عزیزه عسگری
فاطمه جمولی
سعید عباس نژاد
صغری ابراهیمی
میلاد رضایی
قاسم کاکوک ثو
مهدی میرمحمدی
میثم خرد روستا
فرشید اصلانی کلانتری
محمد حسینی بیستونی
محمدرضا شمس الدین سعید
قاسم یوسفی
مریم بابایی خاتونی
امیرحسین هداوندخانی
شباب الله نظر پور
حسن برقمدی
خسرو توده روستا
آرش افشار
سیده زینب شفیعی
علی خدادادی 
رسول قهرمانی
حسین مصدق
جعفر رنجبر فردوسی
بتول داورزنی
اکرم عزیززاده
آرش قربانی
سودابه اخوان
مجید نامداری
سعید آقامحمدی
هادی میسوری
فرهاد صمدی
شکوفه رحیمی
سیما ترابیان
علیرضا پهلوان مازندرانی
علی اکبر کاشی
علیرضا سیری
سعید غفوری راد
صدف فرخنده
حمیدرضا حنایی
احسان شریف نیای راد
محمدعلی بیگی زاده
محمد عابدینی
بانو اعلایی غیاثوند
زهرا حکیمی
یوسف غنی زاده
مهدی رازگردانی
میثم نامور خیر
پرویز نقدی پری
فرج یزدانی
لطیفه شیردل
تیمور پروندی
افسانه ظفرنژاد
سجاد قهرمانی
امیرعلی بختیاری
اشرف فاطمی
آرزو زینل زاده
جواد هزاره
توران حیدری
رضا فرهنگ
تانیا یوسفیان
حسن سلگی
مرتضی دلاور
مریم امیدواری کوهانی
حسن خادمی
هدا کاظم لو
شوذب شاه مرادی
مجید بنی اسدی
علیرضا فیض آبادی فراهانی
احمد توکلی
برجی
فیض اللهی
مریم آهنی
محمد قربانی سعادت
سعید پور اسدی
مهپاد
جواد ابوفاضلی
محمدعلی صادقیان
حسین محسن پور مهربانی
رضا تقوی زاده
اکبر واعظی شاهزاده
بهمن جلیل زاده
مهرداد راحتجو
صابر پرنیان
میترا راستگو
جابر یوسفی
بهرام فصیحی
حوریه طاهرخانی
مهتاب خزایی
مریم قادری
مسعود صادقی
نام زنده یاد ثبت نشده است
حدیث قاسمی
مصطفی جامی عابد
نوید شاهسون
زهره شاه محمدی
عسل بدیعی
نام زنده یاد ثبت نشده است
محمد محمودی
شهناز شاه منصیری';

		$number = explode("\n", $number);
		$name = explode("\n", $name);

		for ($i = 0; $i < count($number); $i++)
		{
			$this->Names_model->insert($number[$i],$name[$i]);
			echo $i . '<br>';

		}
	}
}
?>