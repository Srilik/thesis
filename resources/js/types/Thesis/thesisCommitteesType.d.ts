export interface ThesisCommitteesType {
    id: number | null;
    thesis_id: number;
    lecturer_id: string;
    role: string;
    title: string;
    thesis: {
        id: number;
        topic: string;
    };
    lecturer: {
        id: number;
        name: string;
        gender: string;
        email?: string;
        mobile?: string;
        status?: string;
    };
}
