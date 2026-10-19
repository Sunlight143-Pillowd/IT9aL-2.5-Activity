<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Enrollment System</title>
        <style>
            :root {
                --bg: #f5f7ff;
                --panel: #ffffff;
                --ink: #1f2937;
                --muted: #6b7280;
                --primary: #4f46e5;
                --primary-soft: #eef2ff;
                --success: #10b981;
                --accent: #f59e0b;
                --border: #e5e7eb;
            }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                background: linear-gradient(180deg, #eef2ff 0%, #f8fafc 100%);
                color: var(--ink);
            }
            .container { max-width: 1200px; margin: 40px auto; padding: 0 20px 40px; }
            .header {
                background: linear-gradient(135deg, #312e81, #4f46e5);
                color: white;
                border-radius: 18px;
                padding: 30px 32px;
                box-shadow: 0 18px 40px rgba(79, 70, 229, 0.18);
            }
            .header h1 { margin: 0 0 10px; font-size: clamp(2rem, 4vw, 2.8rem); }
            .header p { margin: 0; opacity: 0.9; font-size: 1rem; }
            .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin: 30px 0; }
            .stat-card {
                background: var(--panel);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 22px 20px;
                box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
            }
            .stat-label { color: var(--muted); font-size: 0.83rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 10px; }
            .stat-value { font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 700; color: var(--ink); }
            .stat-card.primary { background: var(--primary-soft); }
            .stat-card.success { background: #ecfdf5; }
            .stat-card.accent { background: #fffbeb; }
            .section { background: var(--panel); border: 1px solid var(--border); border-radius: 18px; padding: 24px; margin-top: 26px; box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04); }
            .section h2 { margin-top: 0; margin-bottom: 18px; font-size: 1.4rem; }
            table { width: 100%; border-collapse: collapse; }
            th, td { text-align: left; padding: 14px 12px; border-bottom: 1px solid var(--border); }
            th { background: #f8fafc; color: var(--muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.06em; }
            td { font-size: 0.96rem; }
            .badge { display: inline-block; padding: 6px 10px; border-radius: 999px; background: #eef2ff; color: #4338ca; font-size: 0.78rem; font-weight: 700; }
            .empty { background: #f8fafc; color: var(--muted); text-align: center; padding: 20px; border: 1px dashed var(--border); border-radius: 12px; }
            @media (max-width: 640px) { .container { padding: 0 14px 28px; } .header { padding: 24px 20px; } .section { padding: 18px 12px; } th, td { padding: 10px 8px; } }
        </style>
    </head>
    <body>
        <div class="container">
            <header class="header">
                <h1>Student Enrollment System</h1>
                <p>Academic records overview for students, courses, and active enrollments.</p>
            </header>

            <div class="stats-grid">
                <div class="stat-card primary">
                    <div class="stat-label">Students</div>
                    <div class="stat-value"><?php echo $students->count(); ?></div>
                </div>
                <div class="stat-card success">
                    <div class="stat-label">Courses</div>
                    <div class="stat-value"><?php echo $courses->count(); ?></div>
                </div>
                <div class="stat-card accent">
                    <div class="stat-label">Enrollments</div>
                    <div class="stat-value"><?php echo $enrollments->count(); ?></div>
                </div>
            </div>

            <section class="section">
                <h2>Students</h2>
                <?php if ($students->isEmpty()): ?>
                    <div class="empty">No students found.</div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Student Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><span class="badge"><?php echo e($student->student_number); ?></span></td>
                                    <td><?php echo e($student->name); ?></td>
                                    <td><?php echo e($student->email); ?></td>
                                    <td><?php echo e($student->phone ?? 'Not provided'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>

            <section class="section">
                <h2>Courses</h2>
                <?php if ($courses->isEmpty()): ?>
                    <div class="empty">No courses found.</div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $course): ?>
                                <tr>
                                    <td><span class="badge"><?php echo e($course->course_code); ?></span></td>
                                    <td><?php echo e($course->course_name); ?></td>
                                    <td><?php echo e($course->units); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>

            <section class="section">
                <h2>Enrollments</h2>
                <?php if ($enrollments->isEmpty()): ?>
                    <div class="empty">No enrollments found.</div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Enrollment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($enrollments as $enrollment): ?>
                                <tr>
                                    <td><?php echo e($enrollment->student?->name ?? 'Unknown student'); ?></td>
                                    <td><?php echo e($enrollment->course?->course_name ?? 'Unknown course'); ?></td>
                                    <td><?php echo e($enrollment->enrollment_date?->format('M d, Y') ?? 'N/A'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>
        </div>
    </body>
</html>
