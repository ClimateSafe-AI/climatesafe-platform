<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
  :root {
    --green: #1D9E75; --green-light: #E1F5EE; --green-dark: #085041;
    --amber: #EF9F27; --teal: #0F6E56;
    --text: #2C2C2A; --text-muted: #5F5E5A;
    --bg: #ffffff; --surface: #f7faf8;
    --border: rgba(29,158,117,0.15);
  }
  body { font-family: 'DM Sans', sans-serif; color: var(--text); background: var(--bg); overflow-x: hidden; }

  nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0.9rem 1.25rem;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border);
  }
  .logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
  .logo-icon { width: 32px; height: 32px; background: var(--green); border-radius: 7px; display: flex; align-items: center; justify-content: center; }
  .logo-icon svg { width: 18px; height: 18px; fill: white; }
  .logo-text { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--text); font-weight: 700; }
  .logo-text span { color: var(--green); }
  .nav-right { display: flex; align-items: center; gap: 0.75rem; }
  nav ul { list-style: none; display: flex; gap: 1.5rem; }
  nav ul a { text-decoration: none; color: var(--text-muted); font-size: 0.85rem; font-weight: 500; transition: color 0.2s; }
  nav ul a:hover { color: var(--green); }
  .nav-cta { background: var(--green); color: white; border: none; padding: 0.5rem 1.1rem; border-radius: 6px; font-size: 0.85rem; font-weight: 500; cursor: pointer; font-family: inherit; white-space: nowrap; }
  .hamburger { display: none; flex-direction: column; gap: 4px; cursor: pointer; padding: 4px; background: none; border: none; }
  .hamburger span { width: 22px; height: 2px; background: var(--text); border-radius: 2px; transition: all 0.3s; display: block; }
  .mobile-menu { display: none; position: fixed; top: 58px; left: 0; right: 0; background: white; border-bottom: 1px solid var(--border); padding: 1rem 1.25rem; z-index: 99; flex-direction: column; gap: 0.75rem; }
  .mobile-menu.open { display: flex; }
  .mobile-menu a { text-decoration: none; color: var(--text-muted); font-size: 0.95rem; padding: 0.5rem 0; border-bottom: 1px solid var(--border); }
  .mobile-menu .mob-cta { background: var(--green); color: white; padding: 0.75rem; border-radius: 8px; text-align: center; border: none; margin-top: 0.25rem; font-weight: 500; }

  .hero {
    min-height: 100vh; display: flex; align-items: center;
    padding: 7rem 1.25rem 4rem;
    background: linear-gradient(160deg, #f7faf8 0%, #e8f7f2 40%, #fff 100%);
    position: relative; overflow: hidden;
  }
  .hero-blob { position: absolute; right: -15%; top: 10%; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(29,158,117,0.08) 0%, transparent 70%); pointer-events: none; }
  .hero-inner { max-width: 1100px; margin: 0 auto; width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; position: relative; }
  .badge { display: inline-flex; align-items: center; gap: 6px; background: var(--green-light); color: var(--teal); font-size: 0.75rem; font-weight: 500; padding: 0.3rem 0.8rem; border-radius: 20px; margin-bottom: 1.25rem; border: 1px solid rgba(29,158,117,0.2); }
  .badge-dot { width: 6px; height: 6px; background: var(--green); border-radius: 50%; animation: pulse 2s infinite; flex-shrink: 0; }
  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(1.4)} }
  h1 { font-family: 'Playfair Display', serif; font-size: clamp(1.9rem, 5vw, 3.2rem); line-height: 1.2; font-weight: 700; margin-bottom: 1.25rem; }
  h1 em { color: var(--green); font-style: normal; }
  .hero-desc { font-size: 0.97rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem; }
  .hero-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; }
  .btn-primary { background: var(--green); color: white; text-decoration: none; padding: 0.8rem 1.6rem; border-radius: 8px; font-weight: 500; font-size: 0.9rem; font-family: inherit; border: none; cursor: pointer; box-shadow: 0 4px 16px rgba(29,158,117,0.25); transition: background 0.2s, transform 0.15s; display: inline-block; }
  .btn-primary:hover { background: var(--teal); transform: translateY(-2px); }
  .btn-outline { background: transparent; color: var(--green); text-decoration: none; padding: 0.8rem 1.6rem; border-radius: 8px; font-weight: 500; font-size: 0.9rem; border: 1.5px solid var(--green); cursor: pointer; font-family: inherit; display: inline-block; transition: background 0.2s; }
  .btn-outline:hover { background: var(--green-light); }

  .dashboard-card { background: white; border-radius: 14px; padding: 1.25rem; box-shadow: 0 8px 40px rgba(0,0,0,0.09); border: 1px solid rgba(29,158,117,0.1); }
  .dash-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
  .dash-title { font-size: 0.78rem; font-weight: 500; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; }
  .status-live { display: flex; align-items: center; gap: 5px; font-size: 0.72rem; color: var(--green); font-weight: 500; }
  .status-live span { width: 6px; height: 6px; background: var(--green); border-radius: 50%; animation: pulse 1.5s infinite; display: block; }
  .stat-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 0.6rem; margin-bottom: 1rem; }
  .stat-mini { background: var(--surface); border-radius: 8px; padding: 0.7rem; text-align: center; }
  .stat-mini .num { font-size: 1.3rem; font-weight: 700; color: var(--green); font-family: 'Playfair Display', serif; }
  .stat-mini .lbl { font-size: 0.65rem; color: var(--text-muted); margin-top: 2px; }
  .alert-list { display: flex; flex-direction: column; gap: 0.45rem; }
  .alert-item { display: flex; align-items: center; gap: 8px; padding: 0.6rem 0.85rem; border-radius: 7px; font-size: 0.78rem; }
  .alert-item.flood { background: #E6F1FB; color: #185FA5; }
  .alert-item.health { background: #FAEEDA; color: #854F0B; }
  .alert-item.crop { background: var(--green-light); color: var(--teal); }
  .alert-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
  .flood .alert-dot { background: #378ADD; }
  .health .alert-dot { background: #EF9F27; }
  .crop .alert-dot { background: var(--green); }
  .map-preview { height: 80px; background: linear-gradient(135deg, #d4edde 0%, #a8dbc7 100%); border-radius: 8px; margin-top: 0.9rem; position: relative; overflow: hidden; }
  .map-pin { position: absolute; width: 9px; height: 9px; background: var(--green); border-radius: 50%; border: 2px solid white; }
  .map-pin::after { content:''; position:absolute; top:50%;left:50%; transform:translate(-50%,-50%); width:16px;height:16px; background:rgba(29,158,117,0.3); border-radius:50%; animation: ripple 2s infinite; }
  @keyframes ripple { 0%{transform:translate(-50%,-50%) scale(1);opacity:0.8} 100%{transform:translate(-50%,-50%) scale(2.5);opacity:0} }
  .pin1{top:30%;left:40%;} .pin2{top:55%;left:65%;animation-delay:0.7s;} .pin3{top:20%;left:70%;animation-delay:1.3s;}

  .stats-bar { background: var(--green-dark); color: white; padding: 1.75rem 1.25rem; }
  .stats-inner { max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(4,1fr); gap: 1rem; }
  .stat-block { text-align: center; }
  .stat-block .big { font-family: 'Playfair Display', serif; font-size: 1.9rem; font-weight: 700; color: #9FE1CB; }
  .stat-block .lbl { font-size: 0.75rem; opacity: 0.7; margin-top: 3px; }

  .section { padding: 4.5rem 1.25rem; }
  .section-inner { max-width: 1100px; margin: 0 auto; }
  .section-label { font-size: 0.75rem; font-weight: 500; color: var(--green); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.6rem; }
  .section-title { font-family: 'Playfair Display', serif; font-size: clamp(1.6rem, 3vw, 2.3rem); font-weight: 700; margin-bottom: 0.85rem; }
  .section-desc { color: var(--text-muted); font-size: 0.97rem; line-height: 1.75; }

  .modules-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-top: 3rem; }
  .module-card { border-radius: 12px; padding: 1.5rem; border: 1px solid transparent; transition: transform 0.2s, box-shadow 0.2s; position: relative; overflow: hidden; }
  .module-card::before { content:''; position:absolute; top:0;left:0;right:0;height:3px; border-radius:12px 12px 0 0; }
  .module-card:hover { transform: translateY(-3px); box-shadow: 0 10px 32px rgba(0,0,0,0.09); }
  .module-card.green{background:#f0faf6;border-color:rgba(29,158,117,0.2);} .module-card.green::before{background:var(--green);}
  .module-card.blue{background:#EEF5FB;border-color:rgba(55,138,221,0.2);} .module-card.blue::before{background:#378ADD;}
  .module-card.amber{background:#fdf8ef;border-color:rgba(239,159,39,0.2);} .module-card.amber::before{background:var(--amber);}
  .module-card.teal{background:#e8f7f3;border-color:rgba(15,110,86,0.2);} .module-card.teal::before{background:var(--teal);}
  .module-card.coral{background:#fdf0ec;border-color:rgba(216,90,48,0.2);} .module-card.coral::before{background:#D85A30;}
  .module-card.purple{background:#f2f1fd;border-color:rgba(83,74,183,0.2);} .module-card.purple::before{background:#534AB7;}
  .module-card.gray{background:#f5f5f3;border-color:rgba(95,94,90,0.15);} .module-card.gray::before{background:#888780;}
  .mod-icon { width: 40px; height: 40px; border-radius: 9px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.9rem; font-size: 1.2rem; }
  .green .mod-icon{background:rgba(29,158,117,0.12);} .blue .mod-icon{background:rgba(55,138,221,0.12);} .amber .mod-icon{background:rgba(239,159,39,0.15);} .teal .mod-icon{background:rgba(15,110,86,0.12);} .coral .mod-icon{background:rgba(216,90,48,0.12);} .purple .mod-icon{background:rgba(83,74,183,0.1);} .gray .mod-icon{background:rgba(95,94,90,0.1);}
  .module-card h3 { font-size: 1rem; font-weight: 600; margin-bottom: 0.3rem; }
  .module-card .sub { font-size: 0.75rem; font-weight: 500; opacity: 0.6; margin-bottom: 0.75rem; }
  .module-card p { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }

  .tech-section { background: var(--surface); padding: 4.5rem 1.25rem; }
  .tech-inner { max-width: 1100px; margin: 0 auto; }
  .tech-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start; margin-top: 2.5rem; }
  .tech-list { display: flex; flex-direction: column; gap: 0.85rem; }
  .tech-item { display: flex; align-items: flex-start; gap: 0.9rem; padding: 0.9rem 1.1rem; background: white; border-radius: 10px; border: 1px solid var(--border); }
  .tech-item .icon { width: 36px; height: 36px; border-radius: 8px; background: var(--green-light); display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
  .tech-item h4 { font-size: 0.88rem; font-weight: 600; margin-bottom: 2px; }
  .tech-item p { font-size: 0.78rem; color: var(--text-muted); line-height: 1.5; }
  .stack-visual { background: white; border-radius: 12px; padding: 1.25rem; border: 1px solid var(--border); }
  .stack-label { font-size: 0.7rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 0.5rem; }
  .stack-row { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 0.65rem; }
  .stack-tag { background: var(--surface); border: 1px solid var(--border); border-radius: 5px; padding: 0.3rem 0.65rem; font-size: 0.75rem; color: var(--text-muted); font-weight: 500; }
  .stack-tag.highlight { background: var(--green-light); color: var(--teal); border-color: rgba(29,158,117,0.25); }
  .phase-item { display: flex; align-items: center; gap: 8px; font-size: 0.78rem; margin-bottom: 0.5rem; }
  .phase-num { width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.62rem; font-weight: 700; flex-shrink: 0; }

  .cta-section { padding: 5rem 1.25rem; background: var(--green-dark); text-align: center; position: relative; overflow: hidden; }
  .cta-section::before { content:''; position:absolute; top:-40%; left:50%; transform:translateX(-50%); width:600px; height:600px; border-radius:50%; background:rgba(29,158,117,0.15); pointer-events:none; }
  .cta-inner { max-width: 560px; margin: 0 auto; position: relative; }
  .cta-inner h2 { font-family: 'Playfair Display', serif; font-size: clamp(1.6rem, 4vw, 2.2rem); color: white; margin-bottom: 0.9rem; }
  .cta-inner p { color: rgba(255,255,255,0.7); font-size: 0.95rem; line-height: 1.75; margin-bottom: 1.75rem; }
  .cta-actions { display: flex; justify-content: center; gap: 0.75rem; flex-wrap: wrap; }
  .btn-white { background: white; color: var(--green-dark); padding: 0.85rem 1.8rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; border: none; cursor: pointer; font-family: inherit; text-decoration: none; display: inline-block; }
  .btn-ghost { background: transparent; color: white; padding: 0.85rem 1.8rem; border-radius: 8px; font-weight: 500; font-size: 0.9rem; border: 1.5px solid rgba(255,255,255,0.35); cursor: pointer; font-family: inherit; text-decoration: none; display: inline-block; }

  footer { background: #1a1a18; color: rgba(255,255,255,0.55); padding: 2.5rem 1.25rem 2rem; text-align: center; }
  .footer-logo { font-family: 'Playfair Display', serif; font-size: 1.3rem; color: white; margin-bottom: 0.6rem; }
  .footer-logo span { color: #9FE1CB; }
  .footer-links { display: flex; justify-content: center; gap: 1.25rem; margin: 0.75rem 0; flex-wrap: wrap; }
  .footer-links a { color: rgba(255,255,255,0.45); text-decoration: none; font-size: 0.8rem; }
  .footer-links a:hover { color: #9FE1CB; }
  footer p { font-size: 0.8rem; line-height: 1.7; }
  .partners { margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid rgba(255,255,255,0.08); font-size: 0.75rem; }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 768px) {
    nav ul { display: none; }
    .nav-cta { display: none; }
    .hamburger { display: flex; }

    .hero { padding: 6rem 1.1rem 3rem; min-height: auto; }
    .hero-inner { grid-template-columns: 1fr; gap: 2.5rem; }
    .hero-blob { width: 250px; height: 250px; right: -20%; top: 5%; }
    h1 { font-size: 2rem; }
    .hero-desc { font-size: 0.93rem; }
    .hero-actions { flex-direction: column; }
    .btn-primary, .btn-outline { text-align: center; padding: 0.9rem; }

    .stats-inner { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
    .stat-block .big { font-size: 1.6rem; }

    .section { padding: 3.5rem 1.1rem; }
    .modules-grid { grid-template-columns: 1fr; gap: 1rem; }

    .tech-grid { grid-template-columns: 1fr; gap: 2rem; }

    .cta-section { padding: 3.5rem 1.1rem; }
    .cta-actions { flex-direction: column; align-items: center; }
    .btn-white, .btn-ghost { width: 100%; max-width: 280px; text-align: center; }
  }

  @media (max-width: 480px) {
    .hero { padding: 5.5rem 1rem 3rem; }
    h1 { font-size: 1.75rem; }
    .badge { font-size: 0.7rem; }
    .stats-inner { grid-template-columns: repeat(2,1fr); }
    .stat-mini .num { font-size: 1.1rem; }
    .dashboard-card { padding: 1rem; }
    .alert-item { font-size: 0.74rem; padding: 0.55rem 0.75rem; }
  }
</style>
</head>
<body>

<nav>
  <a class="logo" href="#">
    <div class="logo-icon">
      <svg viewBox="0 0 24 24"><path d="M12 2C8.5 2 5 4.5 5 8.5c0 2.5 1.5 4.8 3.5 6.2L12 22l3.5-7.3C17.5 13.3 19 11 19 8.5 19 4.5 15.5 2 12 2zm0 8.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 5.5 12 5.5s2.5 1.1 2.5 2.5-1.1 2.5-2.5 2.5z"/></svg>
    </div>
    <span class="logo-text">Climate<span>Safe</span> AI</span>
  </a>
  <div class="nav-right">
    <ul>
      <li><a href="#modules">Modules</a></li>
      <li><a href="#tech">Technology</a></li>
      <li><a href="#about">About</a></li>
    </ul>
    <button class="nav-cta">Get Early Access</button>
    <button class="hamburger" onclick="toggleMenu()" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <a href="#modules" onclick="toggleMenu()">Modules</a>
  <a href="#tech" onclick="toggleMenu()">Technology</a>
  <a href="#about" onclick="toggleMenu()">About</a>
  <a href="#" class="mob-cta" onclick="toggleMenu()">Get Early Access</a>
</div>

<section class="hero">
  <div class="hero-blob"></div>
  <div class="hero-inner">
    <div>
      <div class="badge"><span class="badge-dot"></span> Open-Source · Uganda & East Africa</div>
      <h1>Climate Resilience <em>Intelligence</em> for Vulnerable Communities</h1>
      <p class="hero-desc">ClimateSafe AI empowers communities, schools, and farmers with real-time climate intelligence, early warning systems, and AI-assisted risk analysis — built for low-resource environments.</p>
      <div class="hero-actions">
        <a href="#" class="btn-primary">Explore the Platform</a>
        <a href="#modules" class="btn-outline">See All Modules</a>
      </div>
    </div>
    <div>
      <div class="dashboard-card">
        <div class="dash-header">
          <span class="dash-title">Live Intelligence Dashboard</span>
          <span class="status-live"><span></span> Live</span>
        </div>
        <div class="stat-row">
          <div class="stat-mini"><div class="num">247</div><div class="lbl">Reports today</div></div>
          <div class="stat-mini"><div class="num">38</div><div class="lbl">Active alerts</div></div>
          <div class="stat-mini"><div class="num">12</div><div class="lbl">Districts</div></div>
        </div>
        <div class="alert-list">
          <div class="alert-item flood"><span class="alert-dot"></span> Flood risk — Mbale District · High</div>
          <div class="alert-item health"><span class="alert-dot"></span> Cholera watch — Kampala North</div>
          <div class="alert-item crop"><span class="alert-dot"></span> Crop stress reported — Soroti</div>
        </div>
        <div class="map-preview">
          <div class="map-pin pin1"></div>
          <div class="map-pin pin2"></div>
          <div class="map-pin pin3"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="stats-bar">
  <div class="stats-inner">
    <div class="stat-block"><div class="big">7</div><div class="lbl">Platform Modules</div></div>
    <div class="stat-block"><div class="big">4</div><div class="lbl">Report Channels</div></div>
    <div class="stat-block"><div class="big">100%</div><div class="lbl">Open Source</div></div>
    <div class="stat-block"><div class="big">Offline</div><div class="lbl">Capable</div></div>
  </div>
</div>

<section class="section" id="modules">
  <div class="section-inner">
    <p class="section-label">Platform Modules</p>
    <h2 class="section-title">One platform, seven resilience systems</h2>
    <p class="section-desc">Each module addresses a critical dimension of climate vulnerability — designed to work independently or as an integrated whole.</p>
    <div class="modules-grid">
      <div class="module-card green"><div class="mod-icon">🌦️</div><h3>CommunityWatch</h3><div class="sub">Community Climate Intelligence</div><p>Real-time environmental reporting via SMS, WhatsApp, mobile web, and offline forms. Communities become climate first-responders.</p></div>
      <div class="module-card blue"><div class="mod-icon">🏥</div><h3>HealthShield</h3><div class="sub">Climate-Health Monitoring</div><p>Detect cholera, malaria, and water contamination outbreaks early with hotspot mapping and localized risk scoring.</p></div>
      <div class="module-card amber"><div class="mod-icon">🌾</div><h3>FarmGuard AI</h3><div class="sub">Agricultural Intelligence</div><p>Drought alerts, rainfall advisories, pest outbreak tracking, and food security mapping for farming communities.</p></div>
      <div class="module-card teal"><div class="mod-icon">🏫</div><h3>ClimateSafe Schools</h3><div class="sub">School Resilience Infrastructure</div><p>Schools as resilience hubs with sanitation monitoring, flood preparedness, and youth climate ambassador programs.</p></div>
      <div class="module-card coral"><div class="mod-icon">🔔</div><h3>AlertNet</h3><div class="sub">Early Warning Systems</div><p>Localized flood, heatwave, disease, and agricultural risk alerts via SMS, WhatsApp, and mobile push notifications.</p></div>
      <div class="module-card purple"><div class="mod-icon">🗺️</div><h3>ResilienceMap</h3><div class="sub">Geospatial Vulnerability Mapping</div><p>Interactive Leaflet.js maps visualizing climate incidents, vulnerable schools, food insecurity, and flood zones.</p></div>
      <div class="module-card gray"><div class="mod-icon">🤖</div><h3>AI Risk Engine</h3><div class="sub">Lightweight AI Analysis</div><p>Incident classification, hotspot detection, trend analysis, and localized risk scoring — built for low-bandwidth environments.</p></div>
    </div>
  </div>
</section>

<section class="tech-section" id="tech">
  <div class="tech-inner">
    <p class="section-label">Technology</p>
    <h2 class="section-title">Built for the real world</h2>
    <div class="tech-grid">
      <div class="tech-list">
        <div class="tech-item"><div class="icon">📱</div><div><h4>Mobile-first & offline-capable</h4><p>Works on low-end Android devices and poor connectivity. Offline forms sync when back online.</p></div></div>
        <div class="tech-item"><div class="icon">⚡</div><div><h4>Low-bandwidth optimized</h4><p>Lightweight payloads, SMS integration, and WhatsApp channels ensure access in rural areas.</p></div></div>
        <div class="tech-item"><div class="icon">🔓</div><div><h4>Open-source digital public good</h4><p>Public GitHub repos, open APIs, and deployment documentation for humanitarian partners.</p></div></div>
        <div class="tech-item"><div class="icon">🧩</div><div><h4>Modular architecture</h4><p>Deploy one module or all seven. Scales from a single school to a national resilience network.</p></div></div>
      </div>
      <div class="stack-visual">
        <div class="stack-label">Backend</div>
        <div class="stack-row"><span class="stack-tag highlight">PHP PDO</span><span class="stack-tag highlight">MySQL</span><span class="stack-tag highlight">RESTful APIs</span></div>
        <div class="stack-label" style="margin-top:0.75rem;">Frontend</div>
        <div class="stack-row"><span class="stack-tag highlight">HTML5</span><span class="stack-tag highlight">Bootstrap</span><span class="stack-tag highlight">Alpine.js</span></div>
        <div class="stack-label" style="margin-top:0.75rem;">Mapping</div>
        <div class="stack-row"><span class="stack-tag highlight">Leaflet.js</span><span class="stack-tag highlight">OpenStreetMap</span></div>
        <div class="stack-label" style="margin-top:0.75rem;">Channels</div>
        <div class="stack-row"><span class="stack-tag">SMS</span><span class="stack-tag">WhatsApp API</span><span class="stack-tag">Mobile Web</span><span class="stack-tag">Offline</span></div>
        <div style="height:1px;background:var(--border);margin:1rem 0;"></div>
        <div class="stack-label">Deployment Phases</div>
        <div class="phase-item"><span class="phase-num" style="background:var(--green);color:white;">1</span><span style="color:var(--text-muted);">MVP Development — Core infrastructure</span></div>
        <div class="phase-item"><span class="phase-num" style="background:rgba(29,158,117,0.3);color:var(--teal);">2</span><span style="color:var(--text-muted);">Pilot — Selected Ugandan communities</span></div>
        <div class="phase-item"><span class="phase-num" style="background:rgba(29,158,117,0.15);color:var(--text-muted);">3</span><span style="color:var(--text-muted);">Community validation & testing</span></div>
        <div class="phase-item"><span class="phase-num" style="background:rgba(29,158,117,0.1);color:var(--text-muted);">4</span><span style="color:var(--text-muted);">Regional scaling — East Africa</span></div>
      </div>
    </div>
  </div>
</section>

<section class="cta-section" id="about">
  <div class="cta-inner">
    <h2>Help build climate resilience across Africa</h2>
    <p>ClimateSafe AI is an open-source digital public good. We're seeking partnerships, pilot communities, and support through UNICEF Climate Ventures 2026.</p>
    <div class="cta-actions">
      <a href="#" class="btn-white">Get Early Access</a>
      <a href="#" class="btn-ghost">View on GitHub</a>
    </div>
  </div>
</section>

<footer>
  <div class="footer-logo">Climate<span>Safe</span> AI</div>
  <div class="footer-links">
    <a href="#">climatesafeai.org</a>
    <a href="#">GitHub</a>
    <a href="#">Documentation</a>
    <a href="#">Contact</a>
  </div>
  <p>Open-source climate resilience intelligence for vulnerable communities, schools, and farmers.</p>
  <div class="partners">Built by <strong style="color:rgba(255,255,255,0.7)">OSP IT Digital Solutions</strong> · Partners: <strong style="color:rgba(255,255,255,0.7)">UGLearn</strong> · <strong style="color:rgba(255,255,255,0.7)">Good Ground Initiative</strong></div>
</footer>

<script>
  function toggleMenu() {
    const m = document.getElementById('mobileMenu');
    m.classList.toggle('open');
  }
  document.addEventListener('click', function(e) {
    const menu = document.getElementById('mobileMenu');
    const nav = document.querySelector('nav');
    if (!nav.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.remove('open');
    }
  });
</script>
</body>
</html>
