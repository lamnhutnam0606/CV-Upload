type CV = {
    full_name: string
    email: string
    phone: string
    summary: string
    ai_status: string,
    created_at: string
}

type Props = {
    cv: CV
    onClose: () => void
}
export default function CvPreview({ cv, onClose }: Props) {
    // console.log(cv);
    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40 border-gray-200">
            <div className="w-full max-w-md bg-black rounded shadow-lg">
                <div className="p-4 space-y-2 text-sm">
                <p><b>Name:</b> {cv.full_name}</p>
                <p><b>Email:</b> {cv.email}</p>
                <p><b>Phone:</b> {cv.phone}</p>
                </div>

                <div className="flex justify-end gap-2 px-4 py-2 border-t">
                <a
                    
                    target="_blank"
                    className="px-3 py-1 text-sm text-white bg-blue-600 rounded"
                >
                    Open file
                </a>

                <button
                    onClick={onClose}
                    className="px-3 py-1 text-sm border rounded"
                >
                    Close
                </button>
                </div>
            </div>
        </div>
    );
}