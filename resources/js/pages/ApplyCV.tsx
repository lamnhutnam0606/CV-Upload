import { usePage, useForm } from "@inertiajs/react";
import React from "react";

interface TitleProp {
    title: string;
};

interface FlashSession {
    // type?: 'success' | 'error' | 'warning';
    // message: string;
    success: string;
}

export default function ApplyCV({title}: TitleProp) {
    const { flash } = usePage<{ flash?: FlashSession }>().props;
    console.log(flash);
    const { data, setData, post, processing, errors } = useForm<{
        cv_file: File | null,
    }>({
        cv_file: null,
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();

        post('/cv/parse', {
            forceFormData: true,
        });
    };

    return (
        <div className="max-w-xl mx-auto mt-10 p-6 border rounded-lg bg-black">
            <h3 className="text-xl text-center font-semibold mb-4">
            { title }
            </h3>
            {flash?.success && (
                <div className={
                    // flash.type === 'success'
                    // ? 'bg-green-100 text-green-800 p-2 rounded'
                    // : 'bg-green-100 text-red-800 p-2 rounded'
                    'bg-green-100 text-green-800 p-2 rounded'
                }>
                    {flash.success}
                </div>
            )}
            <form onSubmit={submit} className="space-y-4">
                <div>
                    <label className="block text-sm font-medium mb-1">
                    CV (PDF)
                    </label>
                    <input
                    type="file"
                    accept=".pdf"
                    className="w-full"
                    onChange={(e) => setData('cv_file', e.target.files ? e.target.files[0] : null)}
                    />

                    {errors.cv_file && (
                        <p className="text-red-500 text-sm">
                            {errors.cv_file}
                        </p>
                    )}
                </div>

                <button
                    type="submit"
                    disabled={processing}
                    className="w-full text-white py-2 rounded hover:bg-green-700"
                >
                    { processing ? 'Uploading...' : 'Upload' }
                </button>
            </form>
        </div>
    );
}
