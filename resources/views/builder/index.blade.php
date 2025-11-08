<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>صفحه‌ساز حرفه‌ای - GrapesJS (فارسی / RTL)</title>

  <!-- متا CSRF برای fetch -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- فونت فارسی پیشنهادی (Vazirmatn) -->
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">

  <!-- CSS های خارجی -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://unpkg.com/grapesjs@0.21.8/dist/css/grapes.min.css" rel="stylesheet">

  <style>
    :root{
      --primary:#0d6efd;
      --secondary:#6c757d;
      --success:#198754;
      --info:#0dcaf0;
      --warning:#ffc107;
      --danger:#dc3545;
      --light:#f8f9fa;
      --dark:#212529;
      --panel-bg:#ffffff;
      --accent:#f1f5f9;
      --border-color:#e6e9ee;
      --text-muted:#6c757d;
      --shadow:0 2px 6px rgba(16,24,40,0.04);
    }

    body{
      font-family: Vazirmatn, Tahoma, sans-serif;
      background: #f4f6f8;
      margin:0;
      padding:0;
      color:#222;
      overflow-x: hidden;
    }

    /* Header (شبیه المنتور) */
    .g-editor-header{
      background:var(--panel-bg);
      border-bottom:1px solid var(--border-color);
      padding:12px 20px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      box-shadow: var(--shadow);
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .g-editor-header .left,
    .g-editor-header .right{display:flex;align-items:center;gap:10px;}
    .g-editor-header .title{
      font-weight:600;
      font-size:16px;
      color: var(--dark);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .g-editor-header .title i {
      color: var(--primary);
    }

    /* Layout */
    .g-editor-wrap{padding:16px 20px;}
    .g-panel {
      background:var(--panel-bg);
      border:1px solid var(--border-color);
      border-radius:8px;
      padding:12px;
      box-shadow: none;
      height: calc(100% - 24px);
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    #blocks, #styles {
      height: calc(80vh - 120px);
      overflow:auto;
      padding:8px;
      flex: 1;
    }

    /* canvas container */
    #gjs {
      height: 80vh;
      border-radius:8px;
      border:1px solid var(--border-color);
      overflow:auto;
      background:#fff;
      direction:ltr; /* داخل canvas از direction: ltr استفاده می‌کنیم مگر محتوای RTL مشخص شود */
      box-shadow: var(--shadow);
    }

    /* blocks style */
    .gjs-block {
      border-radius:6px;
      padding:12px 8px;
      margin-bottom:10px;
      border:1px solid #eef2f7;
      background:#fbfdff;
      text-align:center;
      cursor:grab;
      transition:all .15s;
      font-size:13px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 70px;
    }
    .gjs-block i {
      font-size: 18px;
      margin-bottom: 5px;
      color: var(--primary);
    }
    .gjs-block:hover{
      transform:translateY(-3px); 
      box-shadow: 0 6px 18px rgba(11,22,39,0.08);
      border-color: var(--primary);
    }

    /* selected box outline */
    .gjs-selected{
      outline:2px solid rgba(13,110,253,0.3); 
      outline-offset:3px;
      border-radius: 4px;
    }

    /* floating action buttons */
    .g-floating-actions{
      position:fixed;
      bottom:20px;
      left:50%;
      transform:translateX(-50%);
      z-index:9999;
      display: flex;
      gap: 10px;
    }
    .g-save-toast{
      position:fixed;
      bottom:90px;
      left:50%;
      transform:translateX(-50%);
      z-index:9999;
      min-width: 300px;
    }

    /* responsive small */
    @media (max-width: 768px){
      #gjs{height:65vh;}
      .g-editor-header .title { font-size: 14px; }
      .g-editor-header { padding: 8px 12px; }
      .g-editor-wrap { padding: 10px 12px; }
    }

    /* style manager custom */
    .gjs-sm-sector .gjs-sm-title { 
      background:#f8fafc;
      padding:10px;
      font-weight:600;
      border-radius: 6px 6px 0 0;
      border-bottom: 1px solid var(--border-color);
    }
    .gjs-sm-sector{
      border-radius:6px;
      margin-bottom:12px;
      border: 1px solid var(--border-color);
      overflow: hidden;
    }
    .gjs-sm-property {
      padding: 8px 12px;
      border-bottom: 1px solid #f0f0f0;
    }
    .gjs-sm-property:last-child {
      border-bottom: none;
    }

    /* toolbar small icons */
    .small-icon{font-size:14px}

    /* rtl inside editor helper */
    .rtl-helper {direction:rtl}

    /* بهبود دکمه‌ها */
    .btn {
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.2s;
    }
    .btn:hover {
      transform: translateY(-1px);
    }
    .btn-sm {
      padding: 0.375rem 0.75rem;
      font-size: 0.875rem;
    }

    /* بهبود فرم‌ها */
    .form-control {
      border-radius: 6px;
      border: 1px solid var(--border-color);
    }
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    /* بهبود نوار ابزار */
    .editor-toolbar {
      background: var(--panel-bg);
      border-radius: 8px;
      padding: 8px;
      margin-bottom: 12px;
      border: 1px solid var(--border-color);
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    /* بهبود دسته‌بندی بلوک‌ها */
    .gjs-block-category {
      margin-bottom: 15px;
    }
    .gjs-block-category-title {
      font-weight: 600;
      margin-bottom: 8px;
      padding: 5px 8px;
      background: var(--light);
      border-radius: 4px;
      font-size: 14px;
      color: var(--dark);
    }

    /* بهبود نوتیفیکیشن‌ها */
    .save-alert {
      border-radius: 8px;
      padding: 12px 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      animation: slideUp 0.3s ease-out;
    }
    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    /* بهبود حالت موبایل */
    .device-preview {
      position: relative;
      margin: 0 auto;
      max-width: 100%;
    }
    .device-preview.desktop {
      width: 100%;
    }
    .device-preview.tablet {
      width: 768px;
    }
    .device-preview.mobile {
      width: 375px;
    }

    /* بهبود منوی کشویی */
    .dropdown-menu {
      border-radius: 8px;
      border: 1px solid var(--border-color);
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .dropdown-item {
      padding: 8px 16px;
      font-size: 14px;
    }
    .dropdown-item:hover {
      background-color: var(--light);
    }

    /* بهبود اسکرول بار */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8;
    }

    /* بهبود تب‌ها */
    .editor-tabs {
      display: flex;
      border-bottom: 1px solid var(--border-color);
      margin-bottom: 12px;
    }
    .editor-tab {
      padding: 8px 16px;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      font-weight: 500;
      transition: all 0.2s;
    }
    .editor-tab.active {
      border-bottom-color: var(--primary);
      color: var(--primary);
    }
    .editor-tab:hover {
      background-color: rgba(13, 110, 253, 0.05);
    }

    /* بهبود وضعیت بارگذاری */
    .loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.8);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 10000;
      flex-direction: column;
      gap: 15px;
    }
    .spinner-border {
      width: 3rem;
      height: 3rem;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="g-editor-header">
    <div class="left">
      <button class="btn btn-sm btn-outline-secondary" id="btn-undo" title="بازگشت"><i class="fa fa-undo"></i></button>
      <button class="btn btn-sm btn-outline-secondary" id="btn-redo" title="جلو"><i class="fa fa-redo"></i></button>
      
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="importDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-file-import"></i> وارد کردن
        </button>
        <ul class="dropdown-menu" aria-labelledby="importDropdown">
          <li><a class="dropdown-item" href="#" id="btn-import-file">از فایل</a></li>
          <li><a class="dropdown-item" href="#" id="btn-import-template">از قالب آماده</a></li>
          <li><a class="dropdown-item" href="#" id="btn-import-url">از URL</a></li>
        </ul>
      </div>
      
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-file-export"></i> خروجی
        </button>
        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
          <li><a class="dropdown-item" href="#" id="btn-export-html">HTML</a></li>
          <li><a class="dropdown-item" href="#" id="btn-export-json">JSON</a></li>
          <li><a class="dropdown-item" href="#" id="btn-export-archive">بسته کامل</a></li>
        </ul>
      </div>

      <div style="width:1px;height:28px;background:#eef2f7;margin:0 8px"></div>

      <button class="btn btn-sm btn-outline-primary" id="btn-full-preview" title="پیش‌نمایش کامل">
        <i class="fa fa-eye"></i> پیش‌نمایش
      </button>
    </div>

    <div class="title">
      <i class="fas fa-cube"></i>
      صفحه‌ساز حرفه‌ای — فارسی / RTL
    </div>

    <div class="right">
      <div class="me-2 text-muted small">حالت: <span id="mode-label">ویرایش</span></div>
      <button class="btn btn-sm btn-success" id="btn-save">
        <i class="fa fa-save"></i> ذخیره
      </button>
      <button class="btn btn-sm btn-outline-secondary" id="btn-download">
        <i class="fa fa-download"></i>
      </button>
      <button class="btn btn-sm btn-outline-secondary" id="btn-settings">
        <i class="fa fa-cog"></i>
      </button>
    </div>
  </div>

  <!-- Main editor area -->
  <div class="container-fluid g-editor-wrap">
    <div class="row g-3">
      <!-- Blocks panel -->
      <div class="col-lg-2 col-md-3">
        <div class="g-panel">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <strong>بلوک‌ها</strong>
            <small class="text-muted">درگ کن و رها کن</small>
          </div>
          
          <div class="editor-tabs">
            <div class="editor-tab active" data-tab="blocks">بلوک‌ها</div>
            <div class="editor-tab" data-tab="layers">لایه‌ها</div>
          </div>
          
          <div id="blocks-container">
            <div id="blocks"></div>
          </div>
          
          <div id="layers-container" style="display: none;">
            <div id="layers"></div>
          </div>
          
          <hr>
          
          <div class="d-flex gap-2 mb-3">
            <button class="btn btn-sm btn-outline-secondary w-50" id="add-row">
              <i class="fa fa-plus"></i> ردیف
            </button>
            <button class="btn btn-sm btn-outline-secondary w-50" id="add-section">
              <i class="fa fa-plus"></i> بخش
            </button>
          </div>
          
          <div class="mt-2">
            <label class="form-label small mb-1">جستجو بلوک</label>
            <input id="block-search" class="form-control form-control-sm" placeholder="کلمه کلیدی...">
          </div>
        </div>
      </div>

      <!-- Canvas -->
      <div class="col-lg-8 col-md-9">
        <div class="editor-toolbar">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-desktop" title="دسکتاپ">
              <i class="fa fa-desktop"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-tablet" title="تبلت">
              <i class="fa fa-tablet-alt"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-mobile" title="موبایل">
              <i class="fa fa-mobile-alt"></i>
            </button>
          </div>
          
          <div class="vr mx-2"></div>
          
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-zoom-in" title="بزرگنمایی">
              <i class="fa fa-search-plus"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-zoom-out" title="کوچکنمایی">
              <i class="fa fa-search-minus"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-zoom-reset" title="بازنشانی بزرگنمایی">
              <i class="fa fa-compress"></i>
            </button>
          </div>
          
          <div class="vr mx-2"></div>
          
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-clear" title="پاک کردن صفحه">
              <i class="fa fa-trash"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-template" title="قالب‌ها">
              <i class="fa fa-th-large"></i>
            </button>
          </div>
        </div>
        
        <div id="gjs" class="gjs-editor-cont device-preview desktop"></div>
      </div>

      <!-- Style / Settings -->
      <div class="col-lg-2 d-none d-md-block">
        <div class="g-panel">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <strong>استایل‌ها / تنظیمات</strong>
            <small class="text-muted">ویژگی المان انتخاب‌شده</small>
          </div>
          
          <div class="editor-tabs">
            <div class="editor-tab active" data-tab="styles">استایل‌ها</div>
            <div class="editor-tab" data-tab="attributes">ویژگی‌ها</div>
            <div class="editor-tab" data-tab="settings">تنظیمات</div>
          </div>
          
          <div id="styles-container">
            <div id="styles"></div>
          </div>
          
          <div id="attributes-container" style="display: none;">
            <div id="attributes"></div>
          </div>
          
          <div id="settings-container" style="display: none;">
            <div id="settings"></div>
          </div>
          
          <hr>
          
          <div class="mt-3">
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

  <!-- Floating action area -->
  <div class="g-floating-actions">
    <button class="btn btn-sm btn-primary rounded-circle" id="btn-help" title="راهنما">
      <i class="fa fa-question"></i>
    </button>
    <button class="btn btn-sm btn-danger rounded-circle" id="btn-toggle-panels" title="نمایش/مخفی‌سازی پنل‌ها">
      <i class="fa fa-eye-slash"></i>
    </button>
  </div>
  
  <div id="save-toast" class="g-save-toast"></div>

  <!-- Hidden form for import (file input) -->
  <input type="file" id="import-file" accept=".html,.json" style="display:none">

  <!-- Loader -->
  <div class="loader" id="loader" style="display: none;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">در حال بارگذاری...</span>
    </div>
    <div>لطفا صبر کنید...</div>
  </div>

  <!-- JS libs -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/grapesjs@0.21.8/dist/grapes.min.js"></script>
  <script src="https://unpkg.com/grapesjs-blocks-basic@1.0.1/dist/grapesjs-blocks-basic.min.js"></script>
  <script src="https://unpkg.com/grapesjs-plugin-forms@2.0.5/dist/grapesjs-plugin-forms.min.js"></script>
  <script src="https://unpkg.com/grapesjs-style-bg@2.0.1/dist/grapesjs-style-bg.min.js"></script>
  <script src="https://unpkg.com/grapesjs-touch@0.1.1/dist/grapesjs-touch.min.js"></script>
  <script src="https://unpkg.com/grapesjs-preset-webpage@1.0.3/dist/grapesjs-preset-webpage.min.js"></script>

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
        plugins: [
          'gjs-blocks-basic', 
          'grapesjs-plugin-forms',
          'grapesjs-style-bg',
          'grapesjs-touch',
          'gjs-preset-webpage'
        ],
        pluginsOpts: {
          'gjs-blocks-basic': { 
            flexGrid: true,
            blocksBasicOpts: {
              blocks: ['column1', 'column2', 'column3', 'column3-7', 'text', 'link', 'image', 'video'],
              stylePrefix: 'gjs-'
            }
          },
          'grapesjs-plugin-forms': {},
          'grapesjs-style-bg': {},
          'grapesjs-touch': {},
          'gjs-preset-webpage': {
            blocksBasicOpts: {
              blocks: ['link-block', 'quote', 'text-basic']
            },
            blocks: ['link-block', 'quote', 'text-basic'],
            modalTitleImport: 'وارد کردن HTML',
            modalTitleExport: 'خروجی HTML',
            defaultStyle: true
          }
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
            { 
              name: 'اندازه', 
              open:true, 
              buildProps: ['width','min-height','padding','margin','flex-direction','flex-wrap','justify-content','align-items'] 
            },
            { 
              name: 'تایپوگرافی', 
              open:false, 
              buildProps: ['font-family','font-size','font-weight','color','line-height','text-align','letter-spacing','text-shadow'] 
            },
            { 
              name: 'پس‌زمینه', 
              open:false, 
              buildProps: ['background','background-color','background-image','background-repeat','background-size','background-position'] 
            },
            { 
              name: 'حاشیه', 
              open:false, 
              buildProps: ['border','border-radius','box-shadow'] 
            },
            { 
              name: 'چیدمان', 
              open:false, 
              buildProps: ['display','position','top','right','left','bottom','float','overflow','z-index'] 
            },
            {
              name: 'سایر',
              open: false,
              buildProps: ['transition', 'transform', 'opacity']
            }
          ]
        },
        selectorManager: { appendTo: '#styles' },
        layerManager: {
          appendTo: '#layers'
        },
        panels: { defaults: [] }
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
        content: `<section class="py-5 bg-light text-center">
                    <div class="container">
                      <h1 class="display-5 fw-bold">عنوان اصلی</h1>
                      <p class="lead">متن توضیح کوتاه برای بخش مقدماتی.</p>
                      <div class="d-flex justify-content-center gap-3">
                        <a class="btn btn-primary">تماس</a>
                        <a class="btn btn-outline-primary">اطلاعات بیشتر</a>
                      </div>
                    </div>
                  </section>`
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
        content: `<div class="card" style="width:100%">
                    <img src="https://via.placeholder.com/600x300" class="card-img-top">
                    <div class="card-body">
                      <h5 class="card-title">کارت</h5>
                      <p class="card-text">توضیحات کارت</p>
                      <a class="btn btn-primary">بیشتر</a>
                    </div>
                  </div>`
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
                    <div class="col-md-4">
                      <div class="p-3 text-center border rounded h-100">
                        <i class="fa fa-cog fa-2x mb-2 text-primary"></i>
                        <h5>ویژگی</h5>
                        <p>توضیح کوتاه</p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="p-3 text-center border rounded h-100">
                        <i class="fa fa-shield-alt fa-2x mb-2 text-success"></i>
                        <h5>ویژگی</h5>
                        <p>توضیح کوتاه</p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="p-3 text-center border rounded h-100">
                        <i class="fa fa-rocket fa-2x mb-2 text-danger"></i>
                        <h5>ویژگی</h5>
                        <p>توضیح کوتاه</p>
                      </div>
                    </div>
                  </div>`
      });

      // form block (plugin forms)
      bm.add('contact-form', {
        label: '<i class="fa fa-envelope"></i> فرم تماس',
        category: 'فرم‌ها',
        content: `<form class="p-3 border rounded">
                    <div class="mb-3">
                      <label class="form-label">نام</label>
                      <input class="form-control" placeholder="نام خود را وارد کنید">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">ایمیل</label>
                      <input type="email" class="form-control" placeholder="ایمیل خود را وارد کنید">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">پیام</label>
                      <textarea class="form-control" rows="3" placeholder="پیام خود را وارد کنید"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال</button>
                  </form>`
      });

      // testimonials block
      bm.add('testimonials', {
        label: '<i class="fa fa-quote-right"></i> نظرات کاربران',
        category: 'عناصر',
        content: `<div class="row gy-4">
                    <div class="col-md-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                              <span class="fw-bold">ع</span>
                            </div>
                            <div class="ms-3">
                              <h6 class="mb-0">علی رضایی</h6>
                              <small class="text-muted">مدیر محصول</small>
                            </div>
                          </div>
                          <p class="card-text">"این محصول فوق‌العاده است و به تیم ما کمک زیادی کرده است."</p>
                          <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                              <span class="fw-bold">س</span>
                            </div>
                            <div class="ms-3">
                              <h6 class="mb-0">سارا محمدی</h6>
                              <small class="text-muted">توسعه‌دهنده</small>
                            </div>
                          </div>
                          <p class="card-text">"استفاده از این ابزار بسیار ساده است و نتایج عالی دارد."</p>
                          <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                              <span class="fw-bold">م</span>
                            </div>
                            <div class="ms-3">
                              <h6 class="mb-0">مریم احمدی</h6>
                              <small class="text-muted">طراح UI</small>
                            </div>
                          </div>
                          <p class="card-text">"طراحی‌های زیبا و امکانات کامل، بهترین انتخاب برای تیم ما."</p>
                          <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>`
      });

      // pricing block
      bm.add('pricing', {
        label: '<i class="fa fa-tags"></i> قیمت‌گذاری',
        category: 'عناصر',
        content: `<div class="row g-4">
                    <div class="col-md-4">
                      <div class="card h-100">
                        <div class="card-body text-center">
                          <h5 class="card-title">پایه</h5>
                          <h3 class="card-price">رایگان</h3>
                          <ul class="list-unstyled my-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 1</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 2</li>
                            <li class="mb-2 text-muted"><i class="fas fa-times me-2"></i> قابلیت 3</li>
                            <li class="mb-2 text-muted"><i class="fas fa-times me-2"></i> قابلیت 4</li>
                          </ul>
                          <a href="#" class="btn btn-outline-primary">شروع کنید</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card h-100 border-primary">
                        <div class="card-body text-center">
                          <div class="badge bg-primary mb-3">محبوب</div>
                          <h5 class="card-title">حرفه‌ای</h5>
                          <h3 class="card-price">99,000 <span class="text-muted fw-normal">تومان</span></h3>
                          <ul class="list-unstyled my-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 1</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 2</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 3</li>
                            <li class="mb-2 text-muted"><i class="fas fa-times me-2"></i> قابلیت 4</li>
                          </ul>
                          <a href="#" class="btn btn-primary">خرید کنید</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card h-100">
                        <div class="card-body text-center">
                          <h5 class="card-title">تجاری</h5>
                          <h3 class="card-price">199,000 <span class="text-muted fw-normal">تومان</span></h3>
                          <ul class="list-unstyled my-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 1</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 2</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 3</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> قابلیت 4</li>
                          </ul>
                          <a href="#" class="btn btn-outline-primary">خرید کنید</a>
                        </div>
                      </div>
                    </div>
                  </div>`
      });

      // team block
      bm.add('team', {
        label: '<i class="fa fa-users"></i> تیم',
        category: 'عناصر',
        content: `<div class="row g-4">
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="عضو تیم">
                        <h5>علی رضایی</h5>
                        <p class="text-muted">مدیر عامل</p>
                        <div class="d-flex justify-content-center gap-2">
                          <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="عضو تیم">
                        <h5>سارا محمدی</h5>
                        <p class="text-muted">مدیر محصول</p>
                        <div class="d-flex justify-content-center gap-2">
                          <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="عضو تیم">
                        <h5>مریم احمدی</h5>
                        <p class="text-muted">طراح UI</p>
                        <div class="d-flex justify-content-center gap-2">
                          <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="عضو تیم">
                        <h5>رضا حسینی</h5>
                        <p class="text-muted">توسعه‌دهنده</p>
                        <div class="d-flex justify-content-center gap-2">
                          <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
                          <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>`
      });

      // faq block
      bm.add('faq', {
        label: '<i class="fa fa-question-circle"></i> سوالات متداول',
        category: 'عناصر',
        content: `<div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          سوال اول چیست؟
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                          پاسخ سوال اول در اینجا قرار می‌گیرد. این یک متن نمونه برای نمایش پاسخ سوال است.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          سوال دوم چیست؟
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                          پاسخ سوال دوم در اینجا قرار می‌گیرد. این یک متن نمونه برای نمایش پاسخ سوال است.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          سوال سوم چیست؟
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                          پاسخ سوال سوم در اینجا قرار می‌گیرد. این یک متن نمونه برای نمایش پاسخ سوال است.
                        </div>
                      </div>
                    </div>
                  </div>`
      });

      // cta block
      bm.add('cta', {
        label: '<i class="fa fa-bullhorn"></i> فراخوان به اقدام',
        category: 'عناصر',
        content: `<section class="py-5 bg-primary text-white">
                    <div class="container text-center">
                      <h2 class="mb-3">آماده شروع هستید؟</h2>
                      <p class="lead mb-4">همین امروز با ما تماس بگیرید و کسب‌وکار خود را متحول کنید.</p>
                      <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-light text-primary">شروع کنید</a>
                        <a href="#" class="btn btn-outline-light">اطلاعات بیشتر</a>
                      </div>
                    </div>
                  </section>`
      });

      // footer block
      bm.add('footer', {
        label: '<i class="fa fa-bars"></i> فوتر',
        category: 'بخش',
        content: `<footer class="bg-dark text-white py-5">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4 mb-4">
                          <h5>درباره ما</h5>
                          <p>ما یک تیم حرفه‌ای هستیم که به ارائه بهترین خدمات به مشتریان خود متعهد هستیم.</p>
                          <div class="d-flex gap-3 mt-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                          </div>
                        </div>
                        <div class="col-md-4 mb-4">
                          <h5>لینک‌های سریع</h5>
                          <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50">صفحه اصلی</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50">درباره ما</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50">خدمات</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50">تماس با ما</a></li>
                          </ul>
                        </div>
                        <div class="col-md-4 mb-4">
                          <h5>تماس با ما</h5>
                          <p class="text-white-50"><i class="fas fa-map-marker-alt me-2"></i> تهران، خیابان آزادی</p>
                          <p class="text-white-50"><i class="fas fa-phone me-2"></i> 021-12345678</p>
                          <p class="text-white-50"><i class="fas fa-envelope me-2"></i> info@example.com</p>
                        </div>
                      </div>
                      <hr class="bg-white-50 my-4">
                      <div class="text-center">
                        <p class="mb-0 text-white-50">&copy; 2023 تمامی حقوق محفوظ است.</p>
                      </div>
                    </div>
                  </footer>`
      });

      // initial template (RTL aware)
      const initial = `<div dir="rtl">
        <section class="py-5 bg-white">
          <div class="container">
            <div class="row">
              <div class="col-12 text-center">
                <h1 class="display-5 fw-bold">به صفحه‌ساز خوش آمدید</h1>
                <p class="lead">با کشیدن بلوک‌ها صفحه‌تان را بسازید. فارسی و RTL پشتیبانی می‌شود.</p>
                <div class="d-flex justify-content-center gap-3">
                  <a class="btn btn-primary">شروع کنید</a>
                  <a class="btn btn-outline-primary">مشاهده نمونه کارها</a>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row">
              <div class="col-12 text-center mb-4">
                <h2 class="fw-bold">ویژگی‌های ما</h2>
                <p class="lead">با ما بهترین‌ها را تجربه کنید</p>
              </div>
              <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body text-center p-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                      <i class="fas fa-rocket fa-2x"></i>
                    </div>
                    <h5>سرعت بالا</h5>
                    <p class="text-muted">سرویس‌های ما با بالاترین سرعت ارائه می‌شوند.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body text-center p-4">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                      <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h5>امنیت کامل</h5>
                    <p class="text-muted">اطلاعات شما با امنیت کامل محافظت می‌شوند.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body text-center p-4">
                    <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                      <i class="fas fa-headset fa-2x"></i>
                    </div>
                    <h5>پشتیبانی 24/7</h5>
                    <p class="text-muted">تیم پشتیبانی ما همیشه آماده کمک به شماست.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>`;

      editor.setComponents(initial);

      // Inline rich text editor config (toolbar فارسی)
      editor.RichTextEditor = editor.RichTextEditor || {};
      const rte = editor.RichTextEditor;

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
      document.getElementById('rp-desktop').addEventListener('click', ()=> {
        editor.setDevice('Desktop');
        document.getElementById('gjs').className = 'gjs-editor-cont device-preview desktop';
      });
      document.getElementById('rp-tablet').addEventListener('click', ()=> {
        editor.setDevice('Tablet');
        document.getElementById('gjs').className = 'gjs-editor-cont device-preview tablet';
      });
      document.getElementById('rp-mobile').addEventListener('click', ()=> {
        editor.setDevice('Mobile');
        document.getElementById('gjs').className = 'gjs-editor-cont device-preview mobile';
      });

      // toolbar responsive buttons
      document.getElementById('btn-desktop').addEventListener('click', ()=> {
        editor.setDevice('Desktop');
        document.getElementById('gjs').className = 'gjs-editor-cont device-preview desktop';
      });
      document.getElementById('btn-tablet').addEventListener('click', ()=> {
        editor.setDevice('Tablet');
        document.getElementById('gjs').className = 'gjs-editor-cont device-preview tablet';
      });
      document.getElementById('btn-mobile').addEventListener('click', ()=> {
        editor.setDevice('Mobile');
        document.getElementById('gjs').className = 'gjs-editor-cont device-preview mobile';
      });

      // zoom buttons
      document.getElementById('btn-zoom-in').addEventListener('click', () => {
        const zoom = editor.getZoom();
        editor.setZoom(zoom + 0.1);
      });

      document.getElementById('btn-zoom-out').addEventListener('click', () => {
        const zoom = editor.getZoom();
        editor.setZoom(zoom - 0.1);
      });

      document.getElementById('btn-zoom-reset').addEventListener('click', () => {
        editor.setZoom(1);
      });

      // connect external buttons
      document.getElementById('btn-undo').onclick = ()=> editor.runCommand('core:undo');
      document.getElementById('btn-redo').onclick = ()=> editor.runCommand('core:redo');
      document.getElementById('btn-full-preview').onclick = ()=> editor.runCommand('preview');

      // clear canvas
      document.getElementById('btn-clear').addEventListener('click', () => {
        if (confirm('آیا از پاک کردن صفحه مطمئن هستید؟')) {
          editor.setComponents('');
          editor.setStyle('');
        }
      });

      // templates modal
      document.getElementById('btn-template').addEventListener('click', () => {
        // ایجاد مودال برای نمایش قالب‌ها
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'templatesModal';
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('aria-labelledby', 'templatesModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        
        modal.innerHTML = `
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="templatesModalLabel">قالب‌های آماده</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md-4">
                    <div class="card template-card" data-template="business">
                      <img src="https://via.placeholder.com/300x200?text=Business" class="card-img-top" alt="قالب کسب‌وکار">
                      <div class="card-body">
                        <h5 class="card-title">کسب‌وکار</h5>
                        <p class="card-text">قالب مناسب برای سایت‌های شرکتی و کسب‌وکارها</p>
                        <button class="btn btn-sm btn-primary w-100">استفاده از قالب</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card template-card" data-template="portfolio">
                      <img src="https://via.placeholder.com/300x200?text=Portfolio" class="card-img-top" alt="قالب نمونه کار">
                      <div class="card-body">
                        <h5 class="card-title">نمونه کار</h5>
                        <p class="card-text">قالب مناسب برای نمایش نمونه کارها و رزومه</p>
                        <button class="btn btn-sm btn-primary w-100">استفاده از قالب</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card template-card" data-template="blog">
                      <img src="https://via.placeholder.com/300x200?text=Blog" class="card-img-top" alt="قالب وبلاگ">
                      <div class="card-body">
                        <h5 class="card-title">وبلاگ</h5>
                        <p class="card-text">قالب مناسب برای وبلاگ‌ها و سایت‌های خبری</p>
                        <button class="btn btn-sm btn-primary w-100">استفاده از قالب</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
        
        document.body.appendChild(modal);
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        
        // حذف مودال از DOM پس از بسته شدن
        modal.addEventListener('hidden.bs.modal', () => {
          modal.remove();
        });
        
        // مدیریت رویداد کلیک روی دکمه‌های قالب‌ها
        modal.querySelectorAll('.template-card button').forEach(btn => {
          btn.addEventListener('click', function() {
            const template = this.closest('.template-card').dataset.template;
            loadTemplate(template);
            bsModal.hide();
          });
        });
      });

      // تابع برای بارگذاری قالب‌ها
      function loadTemplate(template) {
        document.getElementById('loader').style.display = 'flex';
        
        // شبیه‌سازی بارگذاری قالب از سرور
        setTimeout(() => {
          let templateContent = '';
          
          switch(template) {
            case 'business':
              templateContent = `<div dir="rtl">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                  <div class="container">
                    <a class="navbar-brand" href="#">شرکت ما</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="#">صفحه اصلی</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">درباره ما</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">خدمات</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">تماس با ما</a></li>
                      </ul>
                    </div>
                  </div>
                </nav>
                
                <section class="py-5 bg-light">
                  <div class="container">
                    <div class="row align-items-center">
                      <div class="col-lg-6">
                        <h1 class="display-4 fw-bold">بهترین راه‌حل‌ها برای کسب‌وکار شما</h1>
                        <p class="lead">ما با ارائه خدمات حرفه‌ای به شما کمک می‌کنیم تا کسب‌وکار خود را به سطح بالاتری برسانید.</p>
                        <div class="d-flex gap-3">
                          <a href="#" class="btn btn-primary">شروع کنید</a>
                          <a href="#" class="btn btn-outline-primary">اطلاعات بیشتر</a>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <img src="https://via.placeholder.com/600x400" class="img-fluid rounded" alt="تصویر">
                      </div>
                    </div>
                  </div>
                </section>
                
                <section class="py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-12 text-center mb-5">
                        <h2 class="fw-bold">خدمات ما</h2>
                        <p class="lead">با ما بهترین‌ها را تجربه کنید</p>
                      </div>
                      <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                          <div class="card-body text-center p-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                              <i class="fas fa-laptop-code fa-2x"></i>
                            </div>
                            <h5>طراحی وب</h5>
                            <p class="text-muted">طراحی حرفه‌ای وب‌سایت‌های مدرن و ریسپانسیو</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                          <div class="card-body text-center p-4">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                              <i class="fas fa-mobile-alt fa-2x"></i>
                            </div>
                            <h5>اپلیکیشن موبایل</h5>
                            <p class="text-muted">توسعه اپلیکیشن‌های موبایل برای اندروید و iOS</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                          <div class="card-body text-center p-4">
                            <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                              <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                            <h5>دیجیتال مارکتینگ</h5>
                            <p class="text-muted">تبلیغات و بازاریابی دیجیتال برای رشد کسب‌وکار</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <section class="py-5 bg-light">
                  <div class="container">
                    <div class="row align-items-center">
                      <div class="col-lg-6">
                        <img src="https://via.placeholder.com/600x400" class="img-fluid rounded" alt="تصویر">
                      </div>
                      <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">چرا ما را انتخاب کنید؟</h2>
                        <div class="d-flex align-items-start mb-3">
                          <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-check"></i>
                          </div>
                          <div>
                            <h5>تیم حرفه‌ای</h5>
                            <p class="text-muted">تیم ما از متخصصان با تجربه در زمینه‌های مختلف تشکیل شده است.</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                          <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-check"></i>
                          </div>
                          <div>
                            <h5>پشتیبانی 24/7</h5>
                            <p class="text-muted">تیم پشتیبانی ما همیشه آماده پاسخگویی به سوالات شماست.</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start">
                          <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-check"></i>
                          </div>
                          <div>
                            <h5>قیمت مناسب</h5>
                            <p class="text-muted">خدمات ما با بهترین کیفیت و قیمت مناسب ارائه می‌شوند.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <section class="py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-12 text-center mb-5">
                        <h2 class="fw-bold">نظرات مشتریان</h2>
                        <p class="lead">مشتریان ما چه می‌گویند</p>
                      </div>
                      <div class="col-md-4 mb-4">
                        <div class="card h-100">
                          <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                              <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <span class="fw-bold">ع</span>
                              </div>
                              <div class="ms-3">
                                <h6 class="mb-0">علی رضایی</h6>
                                <small class="text-muted">مدیر محصول</small>
                              </div>
                            </div>
                            <p class="card-text">"این شرکت خدمات فوق‌العاده‌ای ارائه می‌دهد و تیم بسیار حرفه‌ای دارد."</p>
                            <div class="text-warning">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <div class="card h-100">
                          <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                              <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <span class="fw-bold">س</span>
                              </div>
                              <div class="ms-3">
                                <h6 class="mb-0">سارا محمدی</h6>
                                <small class="text-muted">توسعه‌دهنده</small>
                              </div>
                            </div>
                            <p class="card-text">"از همکاری با این شرکت بسیار راضی هستم و حتماً دوباره با آنها کار خواهم کرد."</p>
                            <div class="text-warning">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star-half-alt"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <div class="card h-100">
                          <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                              <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <span class="fw-bold">م</span>
                              </div>
                              <div class="ms-3">
                                <h6 class="mb-0">مریم احمدی</h6>
                                <small class="text-muted">طراح UI</small>
                              </div>
                            </div>
                            <p class="card-text">"کیفیت کارها عالی است و تحویل به موقع انجام می‌شود. پیشنهاد می‌کنم."</p>
                            <div class="text-warning">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <section class="py-5 bg-primary text-white">
                  <div class="container text-center">
                    <h2 class="mb-3">آماده شروع هستید؟</h2>
                    <p class="lead mb-4">همین امروز با ما تماس بگیرید و کسب‌وکار خود را متحول کنید.</p>
                    <div class="d-flex justify-content-center gap-3">
                      <a href="#" class="btn btn-light text-primary">شروع کنید</a>
                      <a href="#" class="btn btn-outline-light">اطلاعات بیشتر</a>
                    </div>
                  </div>
                </section>
                
                <footer class="bg-dark text-white py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-4 mb-4">
                        <h5>درباره ما</h5>
                        <p>ما یک تیم حرفه‌ای هستیم که به ارائه بهترین خدمات به مشتریان خود متعهد هستیم.</p>
                        <div class="d-flex gap-3 mt-3">
                          <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                          <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                          <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                          <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <h5>لینک‌های سریع</h5>
                        <ul class="list-unstyled">
                          <li class="mb-2"><a href="#" class="text-white-50">صفحه اصلی</a></li>
                          <li class="mb-2"><a href="#" class="text-white-50">درباره ما</a></li>
                          <li class="mb-2"><a href="#" class="text-white-50">خدمات</a></li>
                          <li class="mb-2"><a href="#" class="text-white-50">تماس با ما</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 mb-4">
                        <h5>تماس با ما</h5>
                        <p class="text-white-50"><i class="fas fa-map-marker-alt me-2"></i> تهران، خیابان آزادی</p>
                        <p class="text-white-50"><i class="fas fa-phone me-2"></i> 021-12345678</p>
                        <p class="text-white-50"><i class="fas fa-envelope me-2"></i> info@example.com</p>
                      </div>
                    </div>
                    <hr class="bg-white-50 my-4">
                    <div class="text-center">
                      <p class="mb-0 text-white-50">&copy; 2023 تمامی حقوق محفوظ است.</p>
                    </div>
                  </div>
                </footer>
              </div>`;
              break;
              
            case 'portfolio':
              templateContent = `<div dir="rtl">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                  <div class="container">
                    <a class="navbar-brand" href="#">نمونه کارها</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="#">صفحه اصلی</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">درباره من</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">نمونه کارها</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">تماس با من</a></li>
                      </ul>
                    </div>
                  </div>
                </nav>
                
                <section class="py-5 bg-light">
                  <div class="container text-center">
                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-4" alt="پروفایل">
                    <h1 class="display-4 fw-bold">علی رضایی</h1>
                    <p class="lead">توسعه‌دهنده وب و طراح UI/UX</p>
                    <div class="d-flex justify-content-center gap-3 my-4">
                      <a href="#" class="btn btn-primary">دانلود رزومه</a>
                      <a href="#" class="btn btn-outline-primary">تماس با من</a>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                      <a href="#" class="text-dark fs-4"><i class="fab fa-github"></i></a>
                      <a href="#" class="text-primary fs-4"><i class="fab fa-linkedin"></i></a>
                      <a href="#" class="text-info fs-4"><i class="fab fa-twitter"></i></a>
                      <a href="#" class="text-danger fs-4"><i class="fab fa-instagram"></i></a>
                    </div>
                  </div>
                </section>
                
                <section class="py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-6 mb-4">
                        <h2 class="fw-bold mb-4">درباره من</h2>
                        <p>من یک توسعه‌دهنده وب با بیش از 5 سال تجربه در زمینه طراحی و توسعه وب‌سایت‌ها و اپلیکیشن‌های وب هستم. به طراحی رابط‌کاربری و تجربه کاربری علاقه دارم و همیشه سعی می‌کنم بهترین تجربه را برای کاربران فراهم کنم.</p>
                        <p>در حال حاضر به عنوان توسعه‌دهنده ارشد در یک شرکت فناوری فعالیت می‌کنم و روی پروژه‌های مختلفی کار کرده‌ام.</p>
                        <div class="row mt-4">
                          <div class="col-sm-6 mb-3">
                            <h6><span class="text-primary">نام:</span> علی رضایی</h6>
                          </div>
                          <div class="col-sm-6 mb-3">
                            <h6><span class="text-primary">سن:</span> 28 سال</h6>
                          </div>
                          <div class="col-sm-6 mb-3">
                            <h6><span class="text-primary">شهر:</span> تهران</h6>
                          </div>
                          <div class="col-sm-6 mb-3">
                            <h6><span class="text-primary">ایمیل:</span> ali@example.com</h6>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">مهارت‌ها</h2>
                        <div class="mb-3">
                          <div class="d-flex justify-content-between mb-1">
                            <span>HTML/CSS</span>
                            <span>95%</span>
                          </div>
                          <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 95%"></div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="d-flex justify-content-between mb-1">
                            <span>JavaScript</span>
                            <span>90%</span>
                          </div>
                          <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 90%"></div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="d-flex justify-content-between mb-1">
                            <span>React</span>
                            <span>85%</span>
                          </div>
                          <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%"></div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="d-flex justify-content-between mb-1">
                            <span>Node.js</span>
                            <span>80%</span>
                          </div>
                          <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"></div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="d-flex justify-content-between mb-1">
                            <span>UI/UX Design</span>
                            <span>75%</span>
                          </div>
                          <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <section class="py-5 bg-light">
                  <div class="container">
                    <div class="text-center mb-5">
                      <h2 class="fw-bold">نمونه کارها</h2>
                      <p class="lead">برخی از پروژه‌های اخیر من</p>
                    </div>
                    <div class="row g-4">
                      <div class="col-md-4">
                        <div class="card">
                          <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="پروژه 1">
                          <div class="card-body">
                            <h5 class="card-title">پروژه 1</h5>
                            <p class="card-text">توضیحات مختصری در مورد این پروژه و تکنولوژی‌های استفاده شده در آن.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">مشاهده جزئیات</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
                          <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="پروژه 2">
                          <div class="card-body">
                            <h5 class="card-title">پروژه 2</h5>
                            <p class="card-text">توضیحات مختصری در مورد این پروژه و تکنولوژی‌های استفاده شده در آن.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">مشاهده جزئیات</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
                          <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="پروژه 3">
                          <div class="card-body">
                            <h5 class="card-title">پروژه 3</h5>
                            <p class="card-text">توضیحات مختصری در مورد این پروژه و تکنولوژی‌های استفاده شده در آن.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">مشاهده جزئیات</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
                          <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="پروژه 4">
                          <div class="card-body">
                            <h5 class="card-title">پروژه 4</h5>
                            <p class="card-text">توضیحات مختصری در مورد این پروژه و تکنولوژی‌های استفاده شده در آن.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">مشاهده جزئیات</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
                          <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="پروژه 5">
                          <div class="card-body">
                            <h5 class="card-title">پروژه 5</h5>
                            <p class="card-text">توضیحات مختصری در مورد این پروژه و تکنولوژی‌های استفاده شده در آن.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">مشاهده جزئیات</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
                          <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="پروژه 6">
                          <div class="card-body">
                            <h5 class="card-title">پروژه 6</h5>
                            <p class="card-text">توضیحات مختصری در مورد این پروژه و تکنولوژی‌های استفاده شده در آن.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">مشاهده جزئیات</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <section class="py-5">
                  <div class="container">
                    <div class="text-center mb-5">
                      <h2 class="fw-bold">تماس با من</h2>
                      <p class="lead">برای همکاری یا سوالات با من در ارتباط باشید</p>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <form>
                          <div class="mb-3">
                            <label class="form-label">نام و نام خانوادگی</label>
                            <input type="text" class="form-control" placeholder="نام خود را وارد کنید">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">ایمیل</label>
                            <input type="email" class="form-control" placeholder="ایمیل خود را وارد کنید">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">موضوع</label>
                            <input type="text" class="form-control" placeholder="موضوع پیام را وارد کنید">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">پیام</label>
                            <textarea class="form-control" rows="5" placeholder="پیام خود را وارد کنید"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">ارسال پیام</button>
                        </form>
                      </div>
                      <div class="col-md-6">
                        <div class="card h-100">
                          <div class="card-body">
                            <h5 class="card-title mb-4">اطلاعات تماس</h5>
                            <div class="d-flex align-items-start mb-3">
                              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-map-marker-alt"></i>
                              </div>
                              <div>
                                <h6>آدرس</h6>
                                <p class="text-muted">تهران، خیابان آزادی، پلاک 123</p>
                              </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-phone"></i>
                              </div>
                              <div>
                                <h6>تلفن</h6>
                                <p class="text-muted">021-12345678</p>
                              </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-envelope"></i>
                              </div>
                              <div>
                                <h6>ایمیل</h6>
                                <p class="text-muted">ali@example.com</p>
                              </div>
                            </div>
                            <div class="d-flex align-items-start">
                              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-globe"></i>
                              </div>
                              <div>
                                <h6>وب‌سایت</h6>
                                <p class="text-muted">www.example.com</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <footer class="bg-dark text-white py-4 text-center">
                  <div class="container">
                    <p class="mb-0">&copy; 2023 تمامی حقوق محفوظ است. طراحی و توسعه توسط علی رضایی</p>
                  </div>
                </footer>
              </div>`;
              break;
              
            case 'blog':
              templateContent = `<div dir="rtl">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                  <div class="container">
                    <a class="navbar-brand" href="#">وبلاگ من</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="#">صفحه اصلی</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">درباره من</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">مقالات</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">تماس با من</a></li>
                      </ul>
                      <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="جستجو..." aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">جستجو</button>
                      </form>
                    </div>
                  </div>
                </nav>
                
                <section class="py-5 bg-light">
                  <div class="container text-center">
                    <h1 class="display-4 fw-bold">به وبلاگ من خوش آمدید</h1>
                    <p class="lead">در اینجا مقالاتی در مورد تکنولوژی، برنامه‌نویسی و طراحی وب منتشر می‌کنم</p>
                    <div class="d-flex justify-content-center gap-3">
                      <a href="#" class="btn btn-primary">مشاهده مقالات</a>
                      <a href="#" class="btn btn-outline-primary">درباره من</a>
                    </div>
                  </div>
                </section>
                
                <section class="py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="card mb-4">
                          <img src="https://via.placeholder.com/800x400" class="card-img-top" alt="مقاله 1">
                          <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                              <small class="text-muted"><i class="far fa-calendar"></i> 15 خرداد 1402</small>
                              <small class="text-muted"><i class="far fa-user"></i> علی رضایی</small>
                            </div>
                            <h2 class="card-title">عنوان مقاله اول</h2>
                            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است...</p>
                            <a href="#" class="btn btn-primary">ادامه مطلب</a>
                          </div>
                        </div>
                        
                        <div class="card mb-4">
                          <img src="https://via.placeholder.com/800x400" class="card-img-top" alt="مقاله 2">
                          <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                              <small class="text-muted"><i class="far fa-calendar"></i> 10 خرداد 1402</small>
                              <small class="text-muted"><i class="far fa-user"></i> علی رضایی</small>
                            </div>
                            <h2 class="card-title">عنوان مقاله دوم</h2>
                            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است...</p>
                            <a href="#" class="btn btn-primary">ادامه مطلب</a>
                          </div>
                        </div>
                        
                        <div class="card mb-4">
                          <img src="https://via.placeholder.com/800x400" class="card-img-top" alt="مقاله 3">
                          <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                              <small class="text-muted"><i class="far fa-calendar"></i> 5 خرداد 1402</small>
                              <small class="text-muted"><i class="far fa-user"></i> علی رضایی</small>
                            </div>
                            <h2 class="card-title">عنوان مقاله سوم</h2>
                            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است...</p>
                            <a href="#" class="btn btn-primary">ادامه مطلب</a>
                          </div>
                        </div>
                        
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">قبلی</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#">بعدی</a>
                            </li>
                          </ul>
                        </nav>
                      </div>
                      
                      <div class="col-lg-4">
                        <div class="card mb-4">
                          <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">درباره من</h5>
                          </div>
                          <div class="card-body text-center">
                            <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="پروفایل">
                            <h5>علی رضایی</h5>
                            <p class="text-muted">توسعه‌دهنده وب و نویسنده</p>
                            <p>من یک توسعه‌دهنده وب با علاقه به نوشتن مقالات در مورد تکنولوژی و برنامه‌نویسی هستم.</p>
                            <div class="d-flex justify-content-center gap-2">
                              <a href="#" class="text-dark fs-5"><i class="fab fa-github"></i></a>
                              <a href="#" class="text-primary fs-5"><i class="fab fa-linkedin"></i></a>
                              <a href="#" class="text-info fs-5"><i class="fab fa-twitter"></i></a>
                              <a href="#" class="text-danger fs-5"><i class="fab fa-instagram"></i></a>
                            </div>
                          </div>
                        </div>
                        
                        <div class="card mb-4">
                          <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">دسته‌بندی‌ها</h5>
                          </div>
                          <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#" class="text-decoration-none">برنامه‌نویسی</a>
                                <span class="badge bg-primary rounded-pill">12</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#" class="text-decoration-none">طراحی وب</a>
                                <span class="badge bg-primary rounded-pill">8</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#" class="text-decoration-none">تکنولوژی</a>
                                <span class="badge bg-primary rounded-pill">15</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#" class="text-decoration-none">گوشی‌های هوشمند</a>
                                <span class="badge bg-primary rounded-pill">5</span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        
                        <div class="card mb-4">
                          <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">مقالات محبوب</h5>
                          </div>
                          <div class="card-body">
                            <div class="d-flex mb-3">
                              <img src="https://via.placeholder.com/100" class="rounded me-3" alt="مقاله" style="width: 80px; height: 80px; object-fit: cover;">
                              <div>
                                <h6><a href="#" class="text-decoration-none">عنوان مقاله محبوب اول</a></h6>
                                <small class="text-muted"><i class="far fa-calendar"></i> 15 خرداد 1402</small>
                              </div>
                            </div>
                            <div class="d-flex mb-3">
                              <img src="https://via.placeholder.com/100" class="rounded me-3" alt="مقاله" style="width: 80px; height: 80px; object-fit: cover;">
                              <div>
                                <h6><a href="#" class="text-decoration-none">عنوان مقاله محبوب دوم</a></h6>
                                <small class="text-muted"><i class="far fa-calendar"></i> 10 خرداد 1402</small>
                              </div>
                            </div>
                            <div class="d-flex">
                              <img src="https://via.placeholder.com/100" class="rounded me-3" alt="مقاله" style="width: 80px; height: 80px; object-fit: cover;">
                              <div>
                                <h6><a href="#" class="text-decoration-none">عنوان مقاله محبوب سوم</a></h6>
                                <small class="text-muted"><i class="far fa-calendar"></i> 5 خرداد 1402</small>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="card">
                          <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">برچسب‌ها</h5>
                          </div>
                          <div class="card-body">
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">HTML</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">CSS</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">JavaScript</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">React</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">Node.js</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">MongoDB</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">Express</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary m-1">Bootstrap</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <section class="py-5 bg-primary text-white">
                  <div class="container text-center">
                    <h2 class="mb-3">عضو خبرنامه شوید</h2>
                    <p class="lead mb-4">برای دریافت آخرین مقالات و اخبار، ایمیل خود را وارد کنید</p>
                    <form class="row justify-content-center">
                      <div class="col-md-6">
                        <div class="input-group">
                          <input type="email" class="form-control" placeholder="ایمیل خود را وارد کنید">
                          <button class="btn btn-light" type="submit">عضویت</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </section>
                
                <footer class="bg-dark text-white py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-4 mb-4">
                        <h5>درباره وبلاگ</h5>
                        <p>این وبلاگ در مورد تکنولوژی، برنامه‌نویسی و طراحی وب است و مقالاتی در این زمینه‌ها منتشر می‌کند.</p>
                        <div class="d-flex gap-3 mt-3">
                          <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                          <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                          <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                          <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <h5>لینک‌های سریع</h5>
                        <ul class="list-unstyled">
                          <li class="mb-2"><a href="#" class="text-white-50">صفحه اصلی</a></li>
                          <li class="mb-2"><a href="#" class="text-white-50">درباره من</a></li>
                          <li class="mb-2"><a href="#" class="text-white-50">مقالات</a></li>
                          <li class="mb-2"><a href="#" class="text-white-50">تماس با من</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 mb-4">
                        <h5>تماس با من</h5>
                        <p class="text-white-50"><i class="fas fa-envelope me-2"></i> ali@example.com</p>
                        <p class="text-white-50"><i class="fas fa-map-marker-alt me-2"></i> تهران، ایران</p>
                      </div>
                    </div>
                    <hr class="bg-white-50 my-4">
                    <div class="text-center">
                      <p class="mb-0 text-white-50">&copy; 2023 تمامی حقوق محفوظ است.</p>
                    </div>
                  </div>
                </footer>
              </div>`;
              break;
          }
          
          editor.setComponents(templateContent);
          document.getElementById('loader').style.display = 'none';
          
          // نمایش پیام موفقیت
          const toast = document.createElement('div');
          toast.className = 'alert alert-success save-alert';
          toast.textContent = 'قالب با موفقیت بارگذاری شد.';
          document.getElementById('save-toast').innerHTML = '';
          document.getElementById('save-toast').appendChild(toast);
          setTimeout(()=> document.getElementById('save-toast').innerHTML = '', 3000);
        }, 1000);
      }

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
      document.getElementById('btn-import-file').addEventListener('click', ()=> document.getElementById('import-file').click());
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

      document.getElementById('btn-export-html').addEventListener('click', function(){
        const html = editor.getHtml();
        const css  = editor.getCss();
        const fullHtml = `<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><style>${css}</style></head><body>${html}</body></html>`;
        const blob = new Blob([fullHtml],{type:'text/html'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a'); a.href = url; a.download = 'exported_page.html'; a.click(); a.remove();
      });

      document.getElementById('btn-export-json').addEventListener('click', function(){
        const json = {
          components: editor.getComponents(),
          styles: editor.getStyle(),
          html: editor.getHtml(),
          css: editor.getCss()
        };
        const blob = new Blob([JSON.stringify(json, null, 2)],{type:'application/json'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a'); a.href = url; a.download = 'exported_page.json'; a.click(); a.remove();
      });

      document.getElementById('btn-export-archive').addEventListener('click', function(){
        // در اینجا می‌توانید یک بسته کامل شامل HTML، CSS، تصاویر و فایل‌های دیگر ایجاد کنید
        alert('این قابلیت در حال توسعه است.');
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
      document.getElementById('add-row').addEventListener('click', ()=> {
        editor.DomComponents.addComponent({
          tagName: 'div',
          attributes: { class: 'container' },
          components: [{
            tagName: 'div', 
            attributes: { class: 'row' }, 
            components: [{
              tagName: 'div', 
              attributes: { class: 'col-12' }, 
              components: [{ tagName:'p', components: ['ردیف جدید'] }]
            }]
          }]
        });
      });
      
      document.getElementById('add-section').addEventListener('click', ()=> {
        editor.DomComponents.addComponent({
          tagName: 'section',
          attributes: { class: 'py-4' },
          components: [{
            tagName: 'div', 
            attributes: { class: 'container' }, 
            components: [{
              tagName: 'div', 
              attributes: { class: 'row' }, 
              components: [{
                tagName: 'div', 
                attributes: { class: 'col-12' }, 
                components: [{ tagName:'h2', components: ['بخش جدید'] }]
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

      // Tab switching
      document.querySelectorAll('.editor-tab').forEach(tab => {
        tab.addEventListener('click', function() {
          const tabName = this.dataset.tab;
          const parent = this.closest('.g-panel');
          
          // Remove active class from all tabs in this panel
          parent.querySelectorAll('.editor-tab').forEach(t => t.classList.remove('active'));
          // Add active class to clicked tab
          this.classList.add('active');
          
          // Hide all tab content containers
          parent.querySelectorAll('[id$="-container"]').forEach(container => {
            container.style.display = 'none';
          });
          
          // Show selected tab content container
          const container = parent.querySelector(`#${tabName}-container`);
          if (container) {
            container.style.display = 'block';
          }
        });
      });

      // Toggle panels
      document.getElementById('btn-toggle-panels').addEventListener('click', function() {
        const panels = document.querySelectorAll('.col-lg-2, .col-md-3');
        const icon = this.querySelector('i');
        
        panels.forEach(panel => {
          if (panel.style.display === 'none') {
            panel.style.display = '';
            icon.className = 'fa fa-eye-slash';
          } else {
            panel.style.display = 'none';
            icon.className = 'fa fa-eye';
          }
        });
      });

      // Help button
      document.getElementById('btn-help').addEventListener('click', function() {
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'helpModal';
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('aria-labelledby', 'helpModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        
        modal.innerHTML = `
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">راهنمای صفحه‌ساز</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h5>معرفی کلی</h5>
                <p>این صفحه‌ساز به شما امکان می‌دهد صفحات وب را به صورت بصری و بدون نیاز به کدنویسی طراحی کنید. شما می‌توانید بلوک‌های آماده را به صفحه اضافه کرده و آن‌ها را ویرایش کنید.</p>
                
                <h5 class="mt-4">ابزارهای اصلی</h5>
                <ul>
                  <li><strong>بلوک‌ها:</strong> عناصر آماده‌ای که می‌توانید به صفحه اضافه کنید.</li>
                  <li><strong>لایه‌ها:</strong> نمایش ساختار درختی عناصر صفحه.</li>
                  <li><strong>استایل‌ها:</strong> تنظیمات ظاهری عناصر انتخاب شده.</li>
                  <li><strong>ویژگی‌ها:</strong> تنظیمات ویژگی‌های HTML عناصر.</li>
                </ul>
                
                <h5 class="mt-4">میانبرهای صفحه‌کلید</h5>
                <ul>
                  <li><strong>Ctrl/Cmd + S:</strong> ذخیره صفحه</li>
                  <li><strong>Ctrl/Cmd + Z:</strong> بازگشت (Undo)</li>
                  <li><strong>Ctrl/Cmd + Y:</strong> جلو (Redo)</li>
                  <li><strong>Delete:</strong> حذف عنصر انتخاب شده</li>
                </ul>
                
                <h5 class="mt-4">نکات مفید</h5>
                <ul>
                  <li>برای ویرایش متن، روی آن دوبار کلیک کنید.</li>
                  <li>برای انتخاب یک عنصر، روی آن کلیک کنید.</li>
                  <li>برای جابجایی عناصر، آن‌ها را بکشید و رها کنید.</li>
                  <li>می‌توانید از تب‌های مختلف در پنل‌ها برای دسترسی به امکانات بیشتر استفاده کنید.</li>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
              </div>
            </div>
          </div>
        `;
        
        document.body.appendChild(modal);
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        
        // حذف مودال از DOM پس از بسته شدن
        modal.addEventListener('hidden.bs.modal', () => {
          modal.remove();
        });
      });

      // Settings button
      document.getElementById('btn-settings').addEventListener('click', function() {
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'settingsModal';
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('aria-labelledby', 'settingsModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        
        modal.innerHTML = `
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">تنظیمات صفحه‌ساز</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">زبان</label>
                  <select class="form-select">
                    <option selected>فارسی</option>
                    <option>English</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">حالت پیش‌فرض نمایش</label>
                  <select class="form-select">
                    <option selected>دسکتاپ</option>
                    <option>تبلت</option>
                    <option>موبایل</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">قالب پیش‌فرض</label>
                  <select class="form-select">
                    <option selected>خالی</option>
                    <option>کسب‌وکار</option>
                    <option>نمونه کار</option>
                    <option>وبلاگ</option>
                  </select>
                </div>
                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="gridSwitch" checked>
                    <label class="form-check-label" for="gridSwitch">نمایش خطوط شبکه</label>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rtlSwitch" checked>
                    <label class="form-check-label" for="rtlSwitch">حالت راست به چپ (RTL)</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                <button type="button" class="btn btn-primary">ذخیره تنظیمات</button>
              </div>
            </div>
          </div>
        `;
        
        document.body.appendChild(modal);
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        
        // حذف مودال از DOM پس از بسته شدن
        modal.addEventListener('hidden.bs.modal', () => {
          modal.remove();
        });
      });

      // Import from URL
      document.getElementById('btn-import-url').addEventListener('click', function() {
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'importUrlModal';
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('aria-labelledby', 'importUrlModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        
        modal.innerHTML = `
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="importUrlModalLabel">وارد کردن از URL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">آدرس URL</label>
                  <input type="url" class="form-control" id="importUrlInput" placeholder="https://example.com/page.html">
                  <div class="form-text">آدرس صفحه‌ای که می‌خواهید وارد کنید را وارد نمایید.</div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                <button type="button" class="btn btn-primary" id="btn-import-url-confirm">وارد کردن</button>
              </div>
            </div>
          </div>
        `;
        
        document.body.appendChild(modal);
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        
        // حذف مودال از DOM پس از بسته شدن
        modal.addEventListener('hidden.bs.modal', () => {
          modal.remove();
        });
        
        // مدیریت رویداد کلیک روی دکمه وارد کردن
        document.getElementById('btn-import-url-confirm').addEventListener('click', function() {
          const url = document.getElementById('importUrlInput').value;
          if (url) {
            // در اینجا می‌توانید کد برای وارد کردن محتوا از URL را اضافه کنید
            alert('وارد کردن از URL در حال توسعه است.');
            bsModal.hide();
          }
        });
      });

      // Import template
      document.getElementById('btn-import-template').addEventListener('click', function() {
        document.getElementById('btn-template').click();
      });

      // Return basic JSON on save for server side too (optional)
      editor.on('storage:load', data => console.log('storage loaded', data));
    })();
  </script>
</body>
</html>