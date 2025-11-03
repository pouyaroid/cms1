<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>صفحه‌ساز حرفه‌ای - GrapesJS (فارسی / RTL)</title>

  {{-- متا CSRF برای fetch --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- فونت فارسی پیشنهادی (Vazirmatn) --}}
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">

  {{-- CSS های خارجی --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://unpkg.com/grapesjs@0.21.8/dist/css/grapes.min.css" rel="stylesheet">

  <style>
    :root{
      --primary:#0d6efd;
      --panel-bg:#ffffff;
      --accent:#f1f5f9;
    }

    body{
      font-family: Vazirmatn, Tahoma, sans-serif;
      background: #f4f6f8;
      margin:0;
      padding:0;
      color:#222;
    }

    /* Header (شبیه المنتور) */
    .g-editor-header{
      background:var(--panel-bg);
      border-bottom:1px solid #e6e9ee;
      padding:10px 16px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      box-shadow: 0 2px 6px rgba(16,24,40,0.04);
    }
    .g-editor-header .left,
    .g-editor-header .right{display:flex;align-items:center;gap:8px;}
    .g-editor-header .title{font-weight:600;font-size:15px}

    /* Layout */
    .g-editor-wrap{padding:12px 14px;}
    .g-panel {
      background:var(--panel-bg);
      border:1px solid #e6e9ee;
      border-radius:8px;
      padding:10px;
      box-shadow: none;
    }

    #blocks, #styles {
      height: calc(80vh - 20px);
      overflow:auto;
      padding:8px;
    }

    /* canvas container */
    #gjs {
      height: 80vh;
      border-radius:8px;
      border:1px solid #e6e9ee;
      overflow:auto;
      background:#fff;
      direction:ltr; /* داخل canvas از direction: ltr استفاده می‌کنیم مگر محتوای RTL مشخص شود */
    }

    /* blocks style */
    .gjs-block {
      border-radius:6px;
      padding:8px;
      margin-bottom:8px;
      border:1px solid #eef2f7;
      background:#fbfdff;
      text-align:center;
      cursor:grab;
      transition:all .15s;
      font-size:13px;
    }
    .gjs-block:hover{transform:translateY(-3px); box-shadow: 0 6px 18px rgba(11,22,39,0.04);}

    /* selected box outline */
    .gjs-selected{outline:2px solid rgba(13,110,253,0.18); outline-offset:3px;}

    /* floating action buttons */
    .g-floating-actions{position:fixed;bottom:20px;left:50%;transform:translateX(-50%);z-index:9999}
    .g-save-toast{position:fixed;bottom:90px;left:50%;transform:translateX(-50%);z-index:9999}

    /* responsive small */
    @media (max-width: 768px){
      #gjs{height:65vh;}
    }

    /* style manager custom */
    .gjs-sm-sector .gjs-sm-title {background:#f8fafc;padding:8px;font-weight:600}
    .gjs-sm-sector{border-radius:6px;margin-bottom:10px}

    /* toolbar small icons */
    .small-icon{font-size:14px}

    /* rtl inside editor helper */
    .rtl-helper {direction:rtl}
  </style>
</head>
<body>

  {{-- Header --}}
  <div class="g-editor-header">
    <div class="left">
      <button class="btn btn-sm btn-outline-secondary" id="btn-undo" title="بازگشت"><i class="fa fa-undo"></i></button>
      <button class="btn btn-sm btn-outline-secondary" id="btn-redo" title="جلو"><i class="fa fa-redo"></i></button>
      <button class="btn btn-sm btn-outline-secondary" id="btn-import" title="وارد کردن"><i class="fa fa-file-import"></i></button>
      <button class="btn btn-sm btn-outline-secondary" id="btn-export" title="خروجی HTML"><i class="fa fa-file-export"></i></button>

      <div style="width:1px;height:28px;background:#eef2f7;margin:0 8px"></div>

      <button class="btn btn-sm btn-outline-primary" id="btn-full-preview" title="پیش‌نمایش کامل"><i class="fa fa-eye"></i> پیش‌نمایش</button>
    </div>

    <div class="title">🧱 صفحه‌ساز حرفه‌ای — فارسی / RTL</div>

    <div class="right">
      <div class="me-2 text-muted small">حالت: <span id="mode-label">ویرایش</span></div>
      <button class="btn btn-sm btn-success" id="btn-save"><i class="fa fa-save"></i> ذخیره</button>
      <button class="btn btn-sm btn-outline-secondary" id="btn-download"><i class="fa fa-download"></i></button>
    </div>
  </div>

  {{-- Main editor area --}}
  <div class="container-fluid g-editor-wrap">
    <div class="row g-2">
      {{-- Blocks panel --}}
      <div class="col-lg-2 col-md-3">
        <div class="g-panel">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>بلوک‌ها</strong>
            <small class="text-muted">درگ کن و رها کن</small>
          </div>
          <div id="blocks"></div>
          <hr>
          <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary w-50" id="add-row">افزودن ردیف</button>
            <button class="btn btn-sm btn-outline-secondary w-50" id="add-section">افزودن قسمت</button>
          </div>
          <hr>
          <div class="mt-2">
            <label class="form-label small mb-1">جستجو بلوک</label>
            <input id="block-search" class="form-control form-control-sm" placeholder="کلمه کلیدی...">
          </div>
        </div>
      </div>

      {{-- Canvas --}}
      <div class="col-lg-8 col-md-9">
        <div id="gjs" class="gjs-editor-cont"></div>
      </div>

      {{-- Style / Settings --}}
      <div class="col-lg-2 d-none d-md-block">
        <div class="g-panel">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>استایل‌ها / تنظیمات</strong>
            <small class="text-muted">ویژگی المان انتخاب‌شده</small>
          </div>
          <div id="styles"></div>

          <hr>
          <div class="mt-2">
            <strong class="d-block mb-2">پیش‌نمایش ریسپانسیو</strong>
            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-secondary w-100" id="rp-desktop">Desktop</button>
              <button class="btn btn-sm btn-outline-secondary w-100" id="rp-tablet">Tablet</button>
              <button class="btn btn-sm btn-outline-secondary w-100" id="rp-mobile">Mobile</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Floating action area --}}
  <div class="g-floating-actions"></div>
  <div id="save-toast" class="g-save-toast"></div>

  {{-- Hidden form for import (file input) --}}
  <input type="file" id="import-file" accept=".html,.json" style="display:none">

  {{-- JS libs --}}
  <script src="https://unpkg.com/grapesjs@0.21.8/dist/grapes.min.js"></script>
  <script src="https://unpkg.com/grapesjs-blocks-basic@1.0.1/dist/grapesjs-blocks-basic.min.js"></script>
  <script src="https://unpkg.com/grapesjs-plugin-forms@2.0.5/dist/grapesjs-plugin-forms.min.js"></script>

  <script>
    (function(){
      // CSRF
      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // init editor
      const editor = grapesjs.init({
        container: '#gjs',
        height: '80vh',
        fromElement: false,
        storageManager: false,
        plugins: ['gjs-blocks-basic', 'grapesjs-plugin-forms'],
        pluginsOpts: {
          'gjs-blocks-basic': { flexGrid: true },
          'grapesjs-plugin-forms': {}
        },
        canvas: {
          styles: [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
          ]
        },
        blockManager: {
          appendTo: '#blocks'
        },
        styleManager: {
          appendTo: '#styles',
          sectors: [
            { name: 'اندازه', open:true, buildProps: ['width','min-height','padding','margin'] },
            { name: 'تایپوگرافی', open:false, buildProps: ['font-family','font-size','font-weight','color','line-height','text-align','letter-spacing'] },
            { name: 'پس‌زمینه', open:false, buildProps: ['background','background-color','background-image','background-repeat','background-size'] },
            { name: 'حاشیه', open:false, buildProps: ['border','border-radius','box-shadow'] },
            { name: 'چیدمان', open:false, buildProps: ['display','position','top','right','left','bottom','float'] }
          ]
        },
        selectorManager: { appendTo: '#styles' },
      });

      // --- اضافه کردن بلوک‌های سفارشی (شامل grid 12 ستونه) ---
      const bm = editor.BlockManager;

      // helper: create bootstrap row with n columns
      function bootstrapCols(n){
        const colClass = `col-md-${Math.floor(12/n)}`;
        let inner = '';
        for(let i=0;i<n;i++){
          inner += `<div class="${colClass}"><div class="p-3 border rounded h-100">ستون ${i+1}</div></div>`;
        }
        return `<div class="container"><div class="row">${inner}</div></div>`;
      }

      // base blocks
      bm.add('hero', {
        label: '<i class="fa fa-star"></i> هِرو (Hero)',
        category: 'بخش',
        attributes: { class:'gjs-block-section' },
        content: `<section class="py-5 bg-light"><div class="container"><h1 class="display-5 fw-bold">عنوان اصلی</h1><p class="lead">متن توضیح کوتاه برای بخش مقدماتی.</p><a class="btn btn-primary">تماس</a></div></section>`
      });

      bm.add('text', {
        label: '<i class="fa fa-font"></i> متن',
        category: 'اساسی',
        content: `<div class="p-2"><h4>عنوان</h4><p>متن نمونه فارسی — دوباره کلیک کنید و ویرایش کنید.</p></div>`
      });

      bm.add('image', {
        label: '<i class="fa fa-image"></i> تصویر',
        category: 'اساسی',
        content: { type: 'image', src: 'https://via.placeholder.com/800x400?text=تصویر' }
      });

      bm.add('button', {
        label: '<i class="fa fa-hand-pointer"></i> دکمه',
        category: 'عناصر',
        content: `<a class="btn btn-primary">اکشن</a>`
      });

      bm.add('card', {
        label: '<i class="fa fa-clone"></i> کارت',
        category: 'عناصر',
        content: `<div class="card" style="width:100%"><img src="https://via.placeholder.com/600x300" class="card-img-top"><div class="card-body"><h5 class="card-title">کارت</h5><p class="card-text">توضیحات کارت</p><a class="btn btn-primary">بیشتر</a></div></div>`
      });

      // Grid blocks 1..4 columns (کاربر می‌تواند ستون‌ها را اضافه/حذف کند)
      bm.add('row-1', { label: '1 ستون', category:'ستون‌بندی', content: bootstrapCols(1) });
      bm.add('row-2', { label: '2 ستون', category:'ستون‌بندی', content: bootstrapCols(2) });
      bm.add('row-3', { label: '3 ستون', category:'ستون‌بندی', content: bootstrapCols(3) });
      bm.add('row-4', { label: '4 ستون', category:'ستون‌بندی', content: bootstrapCols(4) });

      // features block
      bm.add('features', {
        label: '<i class="fa fa-list"></i> ویژگی‌ها',
        category: 'عناصر',
        content: `<div class="row gy-3">
                    <div class="col-md-4"><div class="p-3 text-center border rounded"><i class="fa fa-cog fa-2x mb-2 text-primary"></i><h5>ویژگی</h5><p>توضیح کوتاه</p></div></div>
                    <div class="col-md-4"><div class="p-3 text-center border rounded"><i class="fa fa-shield-alt fa-2x mb-2 text-success"></i><h5>ویژگی</h5><p>توضیح کوتاه</p></div></div>
                    <div class="col-md-4"><div class="p-3 text-center border rounded"><i class="fa fa-rocket fa-2x mb-2 text-danger"></i><h5>ویژگی</h5><p>توضیح کوتاه</p></div></div>
                  </div>`
      });

      // form block (plugin forms)
      bm.add('contact-form', {
        label: '<i class="fa fa-envelope"></i> فرم تماس',
        category: 'فرم‌ها',
        content: `<form class="p-3 border rounded">
                    <div class="mb-2"><input class="form-control" placeholder="نام"></div>
                    <div class="mb-2"><input class="form-control" placeholder="ایمیل"></div>
                    <div class="mb-2"><textarea class="form-control" placeholder="پیام"></textarea></div>
                    <button class="btn btn-primary">ارسال</button>
                  </form>`
      });

      // initial template (RTL aware)
      const initial = `<div dir="rtl">
        <section class="py-5 bg-white">
          <div class="container">
            <div class="row">
              <div class="col-12 text-center">
                <h1 class="display-5 fw-bold">به صفحه‌ساز خوش آمدید</h1>
                <p class="lead">با کشیدن بلوک‌ها صفحه‌تان را بسازید. فارسی و RTL پشتیبانی می‌شود.</p>
              </div>
            </div>
          </div>
        </section>
      </div>`;

      editor.setComponents(initial);

      // Inline rich text editor config (toolbar فارسی)
      editor.RichTextEditor = editor.RichTextEditor || {};
      const rte = editor.RichTextEditor;
      // use default but ensure toolbar order; grapesjs handles this; we add localization via titles on commands if needed

      // Panels / Commands (undo/redo/preview)
      const pn = editor.Panels;

      // Add top panel (we will use external buttons to control commands)
      pn.addButton('options', [{
        id: 'undo',
        className: 'fa fa-undo',
        command: 'core:undo',
        attributes: { title: 'بازگشت' }
      }, {
        id: 'redo',
        className: 'fa fa-redo',
        command: 'core:redo',
        attributes: { title: 'جلو' }
      }]);

      // Commands: preview toggling
      editor.Commands.add('preview-mode', {
        run(editor, sender) {
          sender && sender.set('active', 1);
          editor.runCommand('preview');
          document.getElementById('mode-label').textContent = 'پیش‌نمایش';
        },
        stop(editor, sender) {
          sender && sender.set('active', 0);
          document.getElementById('mode-label').textContent = 'ویرایش';
        }
      });

      // responsive buttons
      document.getElementById('rp-desktop').addEventListener('click', ()=> editor.setDevice('Desktop'));
      document.getElementById('rp-tablet').addEventListener('click', ()=> editor.setDevice('Tablet'));
      document.getElementById('rp-mobile').addEventListener('click', ()=> editor.setDevice('Mobile'));

      // connect external buttons
      document.getElementById('btn-undo').onclick = ()=> editor.runCommand('core:undo');
      document.getElementById('btn-redo').onclick = ()=> editor.runCommand('core:redo');
      document.getElementById('btn-full-preview').onclick = ()=> editor.runCommand('preview');

      // Add Save -> POST to server route: /builder/save
      document.getElementById('btn-save').addEventListener('click', async function(){
        const html = editor.getHtml();
        const css  = editor.getCss();
        const fullHtml = `<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><style>${css}</style></head><body>${html}</body></html>`;

        // show saving toast
        const toast = document.createElement('div');
        toast.className = 'alert alert-info save-alert';
        toast.textContent = 'در حال ذخیره...';
        document.getElementById('save-toast').innerHTML = '';
        document.getElementById('save-toast').appendChild(toast);

        try{
          const res = await fetch("{{ route('builder.save') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrf,
              'Accept': 'application/json'
            },
            body: JSON.stringify({ html: fullHtml, css: css })
          });

          if(!res.ok) throw new Error('خطا در ذخیره سازی');

          const data = await res.json().catch(()=> null);
          document.getElementById('save-toast').innerHTML = `<div class="alert alert-success save-alert">صفحه با موفقیت ذخیره شد.</div>`;
          setTimeout(()=> document.getElementById('save-toast').innerHTML = '', 2500);

          // اگر سرور آیدی یا لینک برگرداند می‌توانیم به کاربر نشان دهیم
          if(data && data.url){
            const link = document.createElement('a');
            link.href = data.url;
            link.target = '_blank';
            link.className = 'btn btn-sm btn-outline-primary mt-2';
            link.textContent = 'مشاهده صفحه ذخیره‌شده';
            document.getElementById('save-toast').appendChild(link);
          }
        }catch(err){
          document.getElementById('save-toast').innerHTML = `<div class="alert alert-danger save-alert">ذخیره ناموفق: ${err.message}</div>`;
          setTimeout(()=> document.getElementById('save-toast').innerHTML = '', 3500);
        }
      });

      // Download as file
      document.getElementById('btn-download').addEventListener('click', function(){
        const html = editor.getHtml();
        const css  = editor.getCss();
        const full = `<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><style>${css}</style></head><body>${html}</body></html>`;
        const blob = new Blob([full], { type: 'text/html' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = 'page.html'; document.body.appendChild(a); a.click(); a.remove();
      });

      // Import / Export (JSON + HTML)
      document.getElementById('btn-import').addEventListener('click', ()=> document.getElementById('import-file').click());
      document.getElementById('import-file').addEventListener('change', function(e){
        const f = e.target.files[0];
        if(!f) return;
        const reader = new FileReader();
        reader.onload = function(ev){
          const text = ev.target.result;
          // اگر JSON است (ساختار GrapesJS) سعی می‌کنیم loadComponents
          try{
            const obj = JSON.parse(text);
            if(obj.components || obj.styles){
              editor.setComponents(obj.components || '');
              editor.setStyle(obj.styles || '');
              alert('قالب با موفقیت وارد شد (JSON).');
              return;
            }
          }catch(e){}
          // در غیر اینصورت فرض HTML است
          editor.setComponents(text);
          alert('قالب HTML وارد شد.');
        };
        reader.readAsText(f,'utf-8');
      });

      document.getElementById('btn-export').addEventListener('click', function(){
        const html = editor.getHtml();
        const css  = editor.getCss();
        const fullHtml = `<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><style>${css}</style></head><body>${html}</body></html>`;
        const blob = new Blob([fullHtml], {type:'text/html'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a'); a.href = url; a.download = 'exported_page.html'; a.click(); a.remove();
      });

      // Block search
      document.getElementById('block-search').addEventListener('input', function(e){
        const q = (e.target.value || '').toLowerCase();
        const blocks = document.querySelectorAll('#blocks .gjs-block');
        blocks.forEach(b=>{
          const label = b.innerText.toLowerCase();
          b.style.display = label.indexOf(q) === -1 ? 'none' : 'block';
        });
      });

      // Add row / section buttons (external)
      document.getElementById('add-row').addEventListener('click', ()=> editor.runCommand('core:copy'));
      document.getElementById('add-section').addEventListener('click', ()=> {
        editor.DomComponents.addComponent({
          tagName: 'section',
          attributes: { class: 'py-4' },
          components: [{
            tagName: 'div', attributes: { class: 'container' }, components: [{
              tagName: 'div', attributes: { class: 'row' }, components: [{
                tagName: 'div', attributes: { class: 'col-12' }, components: [{ tagName:'h2', components: ['عنوان بخش'] }]
              }]
            }]
          }]
        });
      });

      // when a component is selected, ensure dir rtl inside text nodes (for Persian)
      editor.on('component:selected', comp => {
        const el = comp.view && comp.view.el;
        if(el){
          // if it's textual, enforce rtl class
          if(el.querySelector && el.querySelector('p, h1, h2, h3, h4, span')){
            el.classList.add('rtl-helper');
          }
        }
      });

      // small UX: add keyboard shortcuts for save (Ctrl/Cmd+S)
      window.addEventListener('keydown', function(e){
        if((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's'){
          e.preventDefault();
          document.getElementById('btn-save').click();
        }
      });

      // Make sure blocks are visible (GrapesJS sometimes hides categories if no blocks)
      setTimeout(()=> {
        // style block categories via DOM if needed
        document.querySelectorAll('#blocks .gjs-block').forEach(b => b.style.display = 'block');
      }, 200);

      // Return basic JSON on save for server side too (optional)
      editor.on('storage:load', data => console.log('storage loaded', data));
    })();
  </script>
</body>
</html>
