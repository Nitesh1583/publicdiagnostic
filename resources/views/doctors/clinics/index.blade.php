<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Clinics</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-teal: #20C997;
            --teal-dark: #047857;
            --bg-light: #F8FAFC;
            --card-bg: #FFFFFF;
            --border: #E5E7EB;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
            --text-dark: #111827;
            --text-muted: #6B7280;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-light);
            min-height: 100vh;
        }

        .page-wrapper {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px 60px;
        }

        .page-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        /* Clinics list */
        .clinics-card {
            background: var(--card-bg);
            border-radius: 18px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 18px 0;
            overflow: hidden;
        }

        .clinics-header {
            padding: 10px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .clinics-header-title {
            font-weight: 600;
            color: var(--text-dark);
        }

        .clinics-count {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .clinic-row {
            padding: 16px 24px;
            border-bottom: 1px solid #F3F4F6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background 0.15s ease, transform 0.15s ease;
        }

        .clinic-row:last-child {
            border-bottom: none;
        }

        .clinic-row:hover {
            background: #F9FAFB;
            transform: translateY(-2px);
        }

        .clinic-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .clinic-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-teal), var(--teal-dark));
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .clinic-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .clinic-address {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .clinic-meta {
            display: flex;
            gap: 14px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .clinic-meta i {
            margin-right: 4px;
            color: var(--primary-teal);
        }

        .clinic-right i {
            color: #9CA3AF;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: #D1D5DB;
            margin-bottom: 16px;
        }

        /* Floating + button (same style as dashboard) */
        .fab-add {
            position: fixed;
            right: 24px;
            bottom: 24px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-teal), var(--teal-dark));
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 16px 40px rgba(4, 120, 87, 0.45);
            cursor: pointer;
            border: none;
            outline: none;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            z-index: 50;
        }

        .fab-add:hover {
            transform: scale(1.06);
            box-shadow: 0 20px 50px rgba(4, 120, 87, 0.6);
        }

        .fab-add i {
            font-size: 1.6rem;
        }

        @media (max-width: 640px) {
            .page-wrapper {
                margin: 20px auto 70px;
            }
            .clinics-card {
                border-radius: 14px;
            }
            .clinic-row {
                padding: 14px 16px;
            }
        }
    </style>
</head>
<body>

<div class="page-wrapper">
    <h1 class="page-title">My Clinics</h1>
    <p class="page-subtitle">All clinics added under your account.</p>

    <div class="clinics-card">
        <div class="clinics-header">
            <div class="clinics-header-title">Clinics</div>
            <div class="clinics-count">{{ $clinics->count() }} total</div>
        </div>

        @forelse ($clinics as $clinic)
            <div class="clinic-row" onclick="window.location='{{ route('doctor.clinics.show', $clinic->id) }}'">
                <div class="clinic-left">
                    <div class="clinic-avatar">
                        {{ strtoupper(Str::substr($clinic->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="clinic-name">{{ $clinic->name }}</div>
                        <div class="clinic-address">
                            {{ $clinic->address ?? 'No address added' }}
                        </div>
                        <div class="clinic-meta">
                            @if($clinic->city)
                                <span><i class="fas fa-location-dot"></i>{{ $clinic->city }}</span>
                            @endif
                            @if($clinic->phone)
                                <span><i class="fas fa-phone"></i>{{ $clinic->phone }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="clinic-right">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-clinic-medical"></i>
                <h4>No clinics added yet</h4>
                <p>Add your first clinic to start managing appointments.</p>
            </div>
        @endforelse
    </div>
</div>