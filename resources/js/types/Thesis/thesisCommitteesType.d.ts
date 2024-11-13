export interface ThesisCommitteesType {
    id: number;
    thesis_id: number;
    lecturer_id: string;
    role: string;
    title: string;
    thesis: {
        id: number;
        name: string;
    };
}
