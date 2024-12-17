export interface ThesisesType {
    id: number;
    group_id: number;
    student: {
        id: string;
        name_of_student: string;
        student_groups?: StudentGroup[];
    };
    academic_year: string;
    major: string;
    year: number;
    batch: number;
    topic: string;
    topic_kh: string;
    objective: string;
    objective_kh: string;
    description: string;
    organization: string;
    organization_type: string;
    organization_address: string;
    organization_phone: string;
    organization_email: string;
    lecturer_id: string;
    lecturer: {
        id: number;
        name: string;
    };
}
export interface StudentGroup {
    gno: string;
    department: string;
    major_id: string;
    year: number;
    semester: string;
    group: string;
    academic_year: string;
    batch: number;
    note: string;
    dmys: string;
    students_count: number;
    dys_attr: string;
    dysg_attr: string;
    shift: string;
    admission: boolean;
    suspend: boolean;
    suspend_date: string;
    suspend_end_date: string;
}
