// Define the structure for a Product with optional category and brand
export interface ThesisStudentsType {
    id: number;
    thesis_id: number;
    student_id: string;
    phone: string;
    email: string;
    remark: string;
    thesis: {
        id: number;
    };
    student: {
        id: string;
        name_of_student: string;
    };
}
