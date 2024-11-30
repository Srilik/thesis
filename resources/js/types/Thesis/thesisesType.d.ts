export interface ThesisesType {
    id: number | null;
    group_id: number;
    student: {
        id: string;
        name_of_student: string;
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
    lecture: {
        id: number;
        name: string;
    };
}
